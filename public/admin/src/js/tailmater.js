(function () {
  "use strict";

  /***********************************/
  /*     Tailmater Js Pro             
  /*     by Ari budin               
  /*==================================
   *     01.  Navbar Toggle          *
   *     02.  Dark Mode              *
   *     03.  Tabs                   *
   *     04.  Range Slider           *
   *     05.  Show Nav Scroll Up     *
   *     06.  Snackbar               *
   *     07.  Dialogs                *
   *     08.  Sheets                 *
   *     09.  Sidebar Menu           *
   *     10.  Dropdown Menus         *
   *     11.  Circle Progress        *
   *     12.  Segmented button       *
   *     13.  Themes Color           *
   *     14.  Preloader              *
   *     15.  Toggle Active          *
   *     16.  Incriase Decrease      *
   *     17.  Lamp intensity         *
   *     18.  Custom JS              *
   ==================================*/

  // ########## 01. Navbar Toggle ##########
  const toggleFunc = () => {
    document.querySelectorAll('[data-type="toggle"]').forEach((toggle) => {
      // show
      function toggleClicks(toggleClickEvent) {
        const clickTarget = toggleClickEvent.currentTarget;
        const toggleId = clickTarget.getAttribute("data-target");
        const activeToggle = document.querySelector(toggleId);
        activeToggle.classList.toggle("show");
        clickTarget.classList.toggle("show");
      }

      toggle.addEventListener("click", toggleClicks);

      if (toggle.checked) {
        const toggleIds = toggle.getAttribute("data-target");
        const activeToggles = document.querySelector(toggleIds);
        activeToggles.classList.add("show");
      }
    });
  };
  toggleFunc();

  // ########## 02. Dark Mode ##########
  // load dark mode from local Storage
  const applyDarkMode = () => {
    const htmlElement = document.querySelector("html");
    const themeToggleElements = document.querySelectorAll('[data-type="theme"]');

    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      htmlElement.classList.add('dark');
      themeToggleElements.forEach((toggle) => {
        toggle.checked = true;
      });
    }

    const darkModeHandler = () => {
      const result = htmlElement.classList.toggle("dark");
      localStorage.setItem("theme", result ? "dark" : "");
    };

    themeToggleElements.forEach((toggle) => {
      toggle.addEventListener("click", darkModeHandler);
    });
  };
  applyDarkMode();

  // ########## 03. Tabs ##########
  const tabs_func = () => {
    const set_tabs = document.querySelectorAll('[data-type="tabs"]');
    const tabIndicator = document.querySelectorAll('[data-type="indicator"]');

    if (set_tabs.length > 0) {
      function TabClicks(tabClickEvent) {
        const clickTarget = tabClickEvent.currentTarget;
        const tabParent = clickTarget.closest('[data-type="tabs-container"]') || tabClickEvent.currentTarget.parentNode.parentNode;
        const set_tabs = tabParent.querySelectorAll('[data-type="tabs"]');
        const tabIndicator = tabParent.querySelectorAll('[data-type="indicator"]');
        const w_set = clickTarget.offsetWidth;

        set_tabs.forEach((tab, i) => {
          tab.classList.remove("active");
          tabIndicator.forEach((indicator, j) => {
            if (clickTarget === tab) {
              indicator.style.left = w_set * i + 'px';
            }
          });
        });
        clickTarget.classList.add("active");

        // content
        tabClickEvent.preventDefault();
        const isTab = tabParent.querySelectorAll('[role="tabpanel"]');
        isTab.forEach(pane => pane.classList.remove("active"));

        const activePaneId = clickTarget.getAttribute("data-target");
        const activePane = tabParent.querySelector(activePaneId);
        activePane.classList.add("active");
      }
      set_tabs.forEach(tab => tab.addEventListener("click", TabClicks));
    }
  };
  tabs_func();

  // ########## 04. Range Slider ##########
  const range_slider_func = () => {
    const ranges = document.querySelectorAll('[data-type="slider"]');

    if (ranges) {
      ranges.forEach((range) => {
        range.nextElementSibling.style.width = `${range.value}%`;

        range.addEventListener('input', () => {
          range.nextElementSibling.style.width = `${range.value}%`;
        });
      });
    }
  };
  range_slider_func();

  // ########## 05. Show Scroll Up ##########
  const handleScroll = (targetSelector, scrollClass, offset = 50) => {
    let previousTop = 0;

    window.addEventListener("scroll", () => {
      const targetElement = document.querySelector(targetSelector);

      if (targetElement !== null) {
        const currentTop = document.body.scrollTop || document.documentElement.scrollTop;
        const minHeader = document.querySelector('header').offsetHeight + offset;
        const classTest = targetElement.classList.contains(scrollClass);

        if (currentTop >= previousTop) {
          // Scroll down
          if (currentTop >= minHeader) {
            targetElement.classList.add("-translate-y-full");

            // Remove if scrolled to top
            if (classTest) {
              targetElement.classList.remove(scrollClass);
            }
          }
        } else {
          // Scroll up
          if (currentTop >= minHeader) {
            targetElement.classList.add(scrollClass);
          } else {
            targetElement.classList.remove(scrollClass, "-translate-y-full");
          }
        }

        previousTop = currentTop <= 0 ? 0 : currentTop;
      }
    });
  };
  handleScroll('[data-type="navtop"]', 'show');
  handleScroll('[data-type="navbar"]', 'show', 'translate-y-full');

  // ########## 06. Snackbar ##########
  const snackbar_func = () => {
    const set_snackbars = document.querySelectorAll('[data-type="snackbar"]');

    if (set_snackbars) {
      const close_snackbar = document.querySelectorAll('[data-close]');

      const toggleSnackbar = (snackbar, show) => {
        snackbar.classList.toggle("show", show);
      };

      const autoHideSnackbar = (snackbar) => {
        setTimeout(() => {
          toggleSnackbar(snackbar, false);
        }, 5000);
      };

      const SnackbarClicks = (SnackbarClickEvent) => {
        const clickTarget = SnackbarClickEvent.currentTarget;
        const SnackbarId = clickTarget.getAttribute("data-target");
        const activeSnackbar = document.querySelector(SnackbarId);
        toggleSnackbar(activeSnackbar, true);
        autoHideSnackbar(activeSnackbar);
      };

      const SnackbarCloses = (SnackbarCloseEvent) => {
        const closeTarget = SnackbarCloseEvent.currentTarget;
        const SnackbarId = closeTarget.getAttribute("data-close");
        const activeSnackbar = document.querySelector(SnackbarId);
        toggleSnackbar(activeSnackbar, false);
      };

      set_snackbars.forEach((snackbar) => {
        snackbar.addEventListener("click", SnackbarClicks);
      });

      close_snackbar.forEach((closeButton) => {
        closeButton.addEventListener("click", SnackbarCloses);
      });
    }
  };
  snackbar_func();

  // ########## 07. Dialogs ##########
  const dialogs_func = () => {
    const set_dialogs = document.querySelectorAll('[data-type="dialogs"]');
    const body = document.querySelector("body");

    if (set_dialogs) {
      const close_dialog = document.querySelectorAll('[data-close]');

      const toggleDialog = (dialog, show) => {
        dialog.classList.toggle("show", show);
        body.style.overflow = show ? "hidden" : "auto";
      };

      const DialogClicks = (DialogClickEvent) => {
        const clickTarget = DialogClickEvent.currentTarget;
        const DialogId = clickTarget.getAttribute("data-target");
        const activeDialog = document.querySelector(DialogId);
        toggleDialog(activeDialog, true);
      };

      const DialogCloses = (DialogCloseEvent) => {
        const closeTarget = DialogCloseEvent.currentTarget;
        const DialogId = closeTarget.getAttribute("data-close");
        const activeDialog = document.querySelector(DialogId);
        toggleDialog(activeDialog, false);
      };

      set_dialogs.forEach((dialog) => {
        dialog.addEventListener("click", DialogClicks);
      });

      close_dialog.forEach((closeButton) => {
        closeButton.addEventListener("click", DialogCloses);
      });
    }
  };
  dialogs_func();

  // ########## 08. Sheets ##########
  const sheets_func = () => {
    const set_sheets = document.querySelectorAll('[data-type="sheets"]');

    if (set_sheets) {
      const close_sheet = document.querySelectorAll('[data-close]');

      const toggleSheet = (sheet, show) => {
        sheet.classList.toggle("show", show);
      };

      const SheetClicks = (SheetClickEvent) => {
        const clickTarget = SheetClickEvent.currentTarget;
        const SheetId = clickTarget.getAttribute("data-target");
        const activeSheet = document.querySelector(SheetId);
        toggleSheet(activeSheet, !activeSheet.classList.contains("show"));
      };

      const SheetCloses = (SheetCloseEvent) => {
        const closeTarget = SheetCloseEvent.currentTarget;
        const SheetId = closeTarget.getAttribute("data-close");
        const activeSheet = document.querySelector(SheetId);
        toggleSheet(activeSheet, false);
      };

      set_sheets.forEach((sheet) => {
        sheet.addEventListener("click", SheetClicks);
      });

      close_sheet.forEach((closeButton) => {
        closeButton.addEventListener("click", SheetCloses);
      });
    }
  };
  sheets_func();

  // ########## 09. Sidebar Accordion ##########
  const accordion_func = () => {
    const set_accordion = document.querySelectorAll('[data-type="collapse"]');

    if (set_accordion) {
      set_accordion.forEach((accordion) => {
        accordion.addEventListener("click", (event) => {
          const clickTarget = event.currentTarget;
          const AccordionId = clickTarget.getAttribute("data-target");
          const activeAccordion = document.querySelector(AccordionId);

          const accParent = event.currentTarget.closest("[data-type='accordion-container']") || event.currentTarget.parentNode.parentNode.parentNode;
          const set_acc = accParent.querySelectorAll('[data-type="collapse"]');
          const is_acc = accParent.querySelectorAll('[data-type="collapsed"]');

          is_acc.forEach((item, j) => {
            if (set_acc[j] !== clickTarget) {
              item.classList.remove("active");
              set_acc[j].classList.remove("active");
            }
          });

          activeAccordion.classList.toggle("active");
          clickTarget.classList.toggle("active");
        });
      });
    }
  };
  accordion_func();

  // ########## 10. Dropdown Menus ##########
  const dropdown_func = () => {
    const set_drop = document.querySelectorAll('[data-type="dropdown"]');

    if (set_drop) {
      const is_drop = document.querySelectorAll('[data-type="dropdownmenu"]');

      const toggleDropdown = (clickTarget) => {
        for (let j = 0; j < is_drop.length; j++) {
          if (set_drop[j] !== clickTarget) {
            is_drop[j].classList.remove("show");
            set_drop[j].classList.remove("show");
          }
        }
      };

      const DropClicks = (event) => {
        const clickTarget = event.currentTarget;
        const DropId = clickTarget.getAttribute("data-target");
        const activeDrop = document.querySelector(DropId);

        toggleDropdown(clickTarget);

        activeDrop.classList.toggle("show");
        clickTarget.classList.toggle("show");
      };

      const windowClickHandler = (event) => {
        if (!event.target.matches('[data-type="dropdown"]')) {
          is_drop.forEach((item, j) => {
            item.classList.remove("show");
            set_drop[j].classList.remove("show");
          });
        }
      };

      set_drop.forEach((dropdown) => {
        dropdown.addEventListener("click", DropClicks);
      });

      window.addEventListener("click", windowClickHandler);
    }
  };
  dropdown_func();

  // ########## 11. Progress ##########
  // Circle progress
  const circleprogress_func = () => {
    const counts = document.querySelectorAll('[data-type="progress_bg"]');

    if (counts) {
      const circles = document.querySelectorAll('[data-type="progress_fill"]');

      counts.forEach((count, i) => {
        let val = count.getAttribute('data-percent');

        if (isNaN(val)) {
          val = 100;
        } else {
          const r = circles[i].getAttribute('r');
          const c = Math.PI * (r * 2);
          val = Math.max(0, Math.min(100, val));
          const pct = ((100 - val) / 100) * c;
          circles[i].style.strokeDashoffset = `${pct}px`;
        }
      });
    }
  };
  circleprogress_func();

  // ########## 12. Segmented button ##########
  const segmented_func = () => {
    const set_check = document.querySelectorAll(".segmented-item > input");

    if (set_check) {
      set_check.forEach((checkbox) => {
        checkbox.addEventListener("click", () => {
          set_check.forEach((input) => {
            input.parentNode.classList.toggle("active", input.checked);
          });
        });
      });
    }
  };
  segmented_func();

  // ########## 13. Themes ##########
  const themes_func = () => {
    const ele = document.getElementsByName('themes');
    const themes = localStorage.getItem('themes');
    const body = document.body;
    let prev = null;

    const setThemes = (theme) => {
      body.classList.add(theme);
    };

    themes && setThemes(themes);

    if (ele) {
      ele.forEach((radio) => {
        radio.addEventListener('change', function () {
          body.classList.remove(prev?.value || themes);
          if (this !== prev) {
            prev = this;
          }
          body.classList.add(this.value);

          localStorage.setItem('themes', this.value);
          console.log(this.value);
        });
      });
    }
  };
  themes_func();

  const layouts_func = () => {
    const ele = document.getElementsByName('layouts');
    const layouts = localStorage.getItem('layouts');
    const body = document.body;
    let prev = null;

    const setLayouts = (layout) => {
      body.classList.add(layout);
    };

    layouts && setLayouts(layouts);

    if (ele) {
      ele.forEach((radio) => {
        radio.addEventListener('change', function () {
          body.classList.remove(prev?.value || layouts);
          if (this !== prev) {
            prev = this;
          }
          body.classList.add(this.value);

          localStorage.setItem('layouts', this.value);
          console.log(this.value);
        });
      });
    }
  };
  layouts_func();

  // ########## 14. Preloader ##########
  const preloader_func = () => {
    const xpre = document.querySelector(".preloader");

    if (xpre) {
      window.addEventListener('load', () => {
        document.body.classList.add("loaded-success");
      });
    }
  };
  preloader_func();

  // ########## 15. Toggle Active ##########
  const toggle_active_func = () => {
    const set_toggle = document.querySelectorAll('[data-type="toggle-active"]');

    if (set_toggle) {
      const toggleClicks = (toggleClickEvent) => {
        const clickTarget = toggleClickEvent.currentTarget;
        const toggleId = clickTarget.getAttribute("data-target");
        const activeToggle = document.querySelector(toggleId);
        activeToggle.classList.toggle("active");
        clickTarget.classList.toggle("active");
      };

      set_toggle.forEach((toggle) => {
        toggle.addEventListener("click", toggleClicks);

        if (toggle.checked) {
          const toggleId = toggle.getAttribute("data-target");
          const activeToggle = document.querySelector(toggleId);
          activeToggle.classList.add("active");
        }
      });
    }
  };
  toggle_active_func();

  // ########## 16. Incriase Decrease ##########
  const incriase_func = () => {
    const set_incriase = document.querySelectorAll('[data-type="incriase_ac"]');
    const set_decrease = document.querySelectorAll('[data-type="decrease_ac"]');

    const clickHandler = (clickEvent, increment) => {
      const clickTarget = clickEvent.currentTarget;
      const idds = clickTarget.getAttribute("data-target");
      const number_el = document.getElementById(idds);

      let val = parseInt(number_el.innerText);
      val = increment ? Math.min(val + 1, 30) : Math.max(val - 1, 16);

      number_el.innerText = val;
    };

    if (set_incriase) {
      set_incriase.forEach((element) => {
        element.addEventListener("click", (event) => clickHandler(event, true));
      });
    }

    if (set_decrease) {
      set_decrease.forEach((element) => {
        element.addEventListener("click", (event) => clickHandler(event, false));
      });
    }
  };
  incriase_func();

  // ########## 17. Lamp ##########
  const range_target_func = () => {
    const ranges = document.querySelectorAll('[data-type="slider-lamp"]');

    ranges.forEach((range, i) => {
      const lamp = document.querySelectorAll('[data-type="lamp"]')[i];

      range.nextElementSibling.style.width = range.value + "%";
      range.previousElementSibling.innerText = range.value + "%";
      lamp.style.opacity = range.value + "%";

      range.addEventListener("input", () => {
        range.nextElementSibling.style.width = range.value + "%";
        range.previousElementSibling.innerText = range.value + "%";
        lamp.style.opacity = range.value + "%";
      });
    });
  };
  range_target_func();

  // ########## 18. Custom JS ##########
  const myCustom = () => {

    // insert your javascript in here

  }
  myCustom();

})();