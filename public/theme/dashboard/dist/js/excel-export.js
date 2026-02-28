/**
 * Excel Export Service
 * Uses SheetJS to convert JSON data to Excel on the client side.
 */

const ExcelExportService = {
    /**
     * Export data to Excel
     * @param {string} url - The URL to fetch data from
     * @param {string} filename - The name of the file to save
     * @param {object} params - Additional query parameters for the fetch
     */
    export: function (url, filename = 'export.xlsx', params = {}) {
        const self = this;

        // Show loading state if you have a loader
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Preparing Data...',
                text: 'Please wait while we fetch and process the data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        const queryString = new URLSearchParams(params).toString();
        const fetchUrl = queryString ? `${url}?${queryString}` : url;

        fetch(fetchUrl)
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success' && res.data) {
                    self.downloadExcel(res.data, filename);
                    if (typeof Swal !== 'undefined') {
                        Swal.close();
                        Swal.fire('Success', 'Data exported successfully!', 'success');
                    }
                } else {
                    throw new Error('Failed to fetch data');
                }
            })
            .catch(error => {
                console.error('Export Error:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error', 'An error occurred during export.', 'error');
                } else {
                    alert('An error occurred during export.');
                }
            });
    },

    /**
     * Internal method to convert and download
     */
    downloadExcel: function (data, filename) {
        const self = this;
        if (typeof XLSX === 'undefined') {
            // Wait for it to load
            console.log('Waiting for SheetJS to load...');
            setTimeout(() => self.downloadExcel(data, filename), 500);
            return;
        }

        // Create a new workbook
        const wb = XLSX.utils.book_new();

        // Convert JSON to worksheet
        const ws = XLSX.utils.json_to_sheet(data);

        // Add worksheet to workbook
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

        // Write and download
        XLSX.writeFile(wb, filename);
    },

    /**
     * Load SheetJS dynamically if not present
     */
    init: function () {
        if (typeof XLSX === 'undefined') {
            const script = document.createElement('script');
            script.src = "https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js";
            document.head.appendChild(script);
        }
    }
};

// Initialize the service
ExcelExportService.init();
