/*
 * Custom interactions replacing what Bootstrap's JS bundle and AdminLTE's
 * adminlte.min.js used to provide. Uses the same data-* attribute API the
 * blade views (and server-generated action columns) already carry, so no
 * markup changes were needed: data-toggle="dropdown", data-toggle="modal"
 * + data-target, data-dismiss="modal"/"alert", data-widget="pushmenu",
 * data-widget="treeview", data-card-widget="collapse".
 */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var body = document.body;

    /* ---------------- sidebar / mobile off-canvas ---------------- */

    var backdrop = document.createElement('div');
    backdrop.className = 'sidebar-backdrop';
    body.appendChild(backdrop);

    function isDesktop() { return window.matchMedia('(min-width: 992px)').matches; }

    function setCollapsed(collapsed) {
      body.classList.toggle('sidebar-collapse', collapsed);
      try { localStorage.setItem('sidebar-collapsed', collapsed ? '1' : '0'); } catch (e) {}
    }
    try {
      if (isDesktop() && localStorage.getItem('sidebar-collapsed') === '1') body.classList.add('sidebar-collapse');
    } catch (e) {}

    window.addEventListener('resize', function () {
      if (isDesktop()) body.classList.remove('sidebar-open');
    });

    /* ---------------- sidebar search ---------------- */

    var sidebarSearchInput = document.querySelector('[data-widget="sidebar-search"] .form-control-sidebar');
    if (sidebarSearchInput) {
      var navSidebar = document.querySelector('.nav-sidebar');
      var sidebarEmptyMsg = document.querySelector('.sidebar-search-empty');
      var topItems = navSidebar
        ? Array.prototype.filter.call(navSidebar.children, function (el) { return el.classList.contains('nav-item'); })
        : [];

      // remember which submenus were open on load (driven by the current route)
      topItems.forEach(function (item) {
        item.dataset.baseOpen = item.classList.contains('menu-open') ? '1' : '0';
      });

      function linkText(link) {
        var p = link.querySelector(':scope > p');
        return (p ? p.textContent : link.textContent).trim().toLowerCase();
      }

      function applySidebarSearch(rawTerm) {
        var term = rawTerm.trim().toLowerCase();

        if (!term) {
          topItems.forEach(function (item) {
            item.classList.remove('search-hide');
            item.classList.toggle('menu-open', item.dataset.baseOpen === '1');
            item.querySelectorAll('.nav-treeview > .nav-item').forEach(function (child) {
              child.classList.remove('search-hide');
            });
          });
          if (sidebarEmptyMsg) sidebarEmptyMsg.classList.add('d-none');
          return;
        }

        var anyVisible = false;

        topItems.forEach(function (item) {
          var link = item.querySelector(':scope > .nav-link');
          var ownMatch = !!link && linkText(link).indexOf(term) !== -1;
          var submenu = item.querySelector(':scope > .nav-treeview');
          var childMatch = false;

          if (submenu) {
            submenu.querySelectorAll(':scope > .nav-item').forEach(function (child) {
              var childLink = child.querySelector(':scope > .nav-link');
              var matches = !!childLink && linkText(childLink).indexOf(term) !== -1;
              child.classList.toggle('search-hide', !matches && !ownMatch);
              if (matches) childMatch = true;
            });
          }

          var visible = ownMatch || childMatch;
          item.classList.toggle('search-hide', !visible);
          if (submenu) item.classList.toggle('menu-open', visible);
          if (visible) anyVisible = true;
        });

        if (sidebarEmptyMsg) sidebarEmptyMsg.classList.toggle('d-none', anyVisible);
      }

      sidebarSearchInput.addEventListener('input', function () { applySidebarSearch(this.value); });
      sidebarSearchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { this.value = ''; applySidebarSearch(''); this.blur(); }
      });

      var sidebarSearchBtn = document.querySelector('[data-widget="sidebar-search"] .btn-sidebar');
      if (sidebarSearchBtn) {
        sidebarSearchBtn.addEventListener('click', function () {
          if (sidebarSearchInput.value) { sidebarSearchInput.value = ''; applySidebarSearch(''); }
          sidebarSearchInput.focus();
        });
      }
    }

    /* ---------------- modal (data-toggle="modal") ---------------- */

    var modalBackdropEl = null;

    function openModal(modal) {
      if (!modal) return;
      closeAllDropdowns();
      modalBackdropEl = document.createElement('div');
      modalBackdropEl.className = 'modal-backdrop';
      body.appendChild(modalBackdropEl);
      body.classList.add('modal-open');
      modal.classList.add('show');
      requestAnimationFrame(function () { modalBackdropEl.classList.add('show'); });
    }

    function closeModal(modal) {
      if (!modal) return;
      modal.classList.remove('show');
      body.classList.remove('modal-open');
      if (modalBackdropEl) { modalBackdropEl.remove(); modalBackdropEl = null; }
    }

    function closeAnyOpenModal() {
      var open = document.querySelector('.modal.show');
      if (open) closeModal(open);
    }

    /* ---------------- dropdown (data-toggle="dropdown") ---------------- */

    function closeAllDropdowns(except) {
      document.querySelectorAll('.dropdown-menu.show').forEach(function (menu) {
        if (menu !== except) menu.classList.remove('show');
      });
      document.querySelectorAll('[data-toggle="dropdown"].dropdown-open').forEach(function (toggle) {
        if (!except || toggle.parentElement.querySelector('.dropdown-menu') !== except) {
          toggle.classList.remove('dropdown-open');
        }
      });
    }

    document.addEventListener('click', function (e) {
      /* pushmenu */
      var pushToggle = e.target.closest('[data-widget="pushmenu"]');
      if (pushToggle) {
        e.preventDefault();
        if (isDesktop()) setCollapsed(!body.classList.contains('sidebar-collapse'));
        else body.classList.toggle('sidebar-open');
        return;
      }

      /* sidebar treeview accordion: any nav-link inside a [data-widget="treeview"]
         container whose nav-item has a submenu toggles that submenu open/closed */
      var treeToggle = e.target.closest('[data-widget="treeview"] .nav-link');
      if (treeToggle) {
        var item = treeToggle.closest('.nav-item');
        if (item && item.querySelector(':scope > .nav-treeview') && treeToggle === item.querySelector(':scope > .nav-link')) {
          e.preventDefault();
          item.classList.toggle('menu-open');
          return;
        }
      }

      /* card collapse widget */
      var cardToggle = e.target.closest('[data-card-widget="collapse"]');
      if (cardToggle) {
        e.preventDefault();
        var card = cardToggle.closest('.card');
        if (card) card.classList.toggle('collapsed-card');
        return;
      }

      /* dropdown toggle */
      var ddToggle = e.target.closest('[data-toggle="dropdown"]');
      if (ddToggle) {
        e.preventDefault();
        e.stopPropagation();
        var menu = ddToggle.nextElementSibling;
        if (!menu || !menu.classList.contains('dropdown-menu')) {
          menu = ddToggle.parentElement.querySelector('.dropdown-menu');
        }
        var isOpen = menu && menu.classList.contains('show');
        closeAllDropdowns();
        if (menu && !isOpen) {
          menu.classList.add('show');
          ddToggle.classList.add('dropdown-open');
        }
        return;
      }

      /* modal open */
      var modalOpener = e.target.closest('[data-toggle="modal"]');
      if (modalOpener) {
        e.preventDefault();
        var targetSel = modalOpener.getAttribute('data-target');
        if (targetSel) openModal(document.querySelector(targetSel));
        return;
      }

      /* modal / alert dismiss */
      var dismiss = e.target.closest('[data-dismiss="modal"]');
      if (dismiss) {
        e.preventDefault();
        closeModal(dismiss.closest('.modal'));
        return;
      }
      var alertDismiss = e.target.closest('[data-dismiss="alert"]');
      if (alertDismiss) {
        e.preventDefault();
        var alertEl = alertDismiss.closest('.alert');
        if (alertEl) alertEl.remove();
        return;
      }

      /* clicking the modal backdrop (the dimmed area, not the dialog) closes it */
      var openModalEl = e.target.closest('.modal.show');
      if (openModalEl && !e.target.closest('.modal-dialog')) {
        closeModal(openModalEl);
        return;
      }

      /* click-away closes open dropdowns */
      if (!e.target.closest('.dropdown-menu')) closeAllDropdowns();

      /* mobile: tapping a real nav link closes the off-canvas sidebar */
      if (e.target === backdrop) { body.classList.remove('sidebar-open'); return; }
      var navLink = e.target.closest('.main-sidebar .nav-link');
      if (navLink && !isDesktop() && navLink.getAttribute('href') && navLink.getAttribute('href') !== '#') {
        body.classList.remove('sidebar-open');
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { closeAllDropdowns(); closeAnyOpenModal(); }
    });
  });
})();
