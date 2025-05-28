/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./build/js/mobile-menu.mjs":
/*!**********************************!*\
  !*** ./build/js/mobile-menu.mjs ***!
  \**********************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   mobileMenu: () => (/* binding */ mobileMenu)
/* harmony export */ });
const mobileMenu = () => {
    const elements = {
        trigger: document.querySelector('.mobile-tav-trigger'),
        menu: document.querySelector('.theme-main-menu'),
        body: document.querySelector('body')
    };

    const toggleMenu = () => {
        elements.menu.classList.toggle('open');
        elements.body.style.position = elements.body.style.position === 'fixed' ? '' : 'fixed';
    };

    elements.trigger.addEventListener('click', toggleMenu);
};

/***/ }),

/***/ "./build/js/nav-scroll.mjs":
/*!*********************************!*\
  !*** ./build/js/nav-scroll.mjs ***!
  \*********************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   navScroll: () => (/* binding */ navScroll)
/* harmony export */ });
const navScroll = () => {
    const sections = document.querySelectorAll('.section');
    const navLi = document.querySelectorAll('.docs-side-nav__item--link');

    window.onscroll = () => {
        let current = "";
      
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            if (scrollY >= sectionTop + 450) {
                current = section.getAttribute("id");
            }
        });
      
        navLi.forEach((li) => {
            li.classList.remove("active");

            if (li.classList.contains(current)) {
                li.classList.add("active");
            }
        });
    };

    // Add active class to side menu items
    const menuItems = document.querySelectorAll(".docs-side-nav__item--link");

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            menuItems.forEach(i => {i.classList.remove('active')})
            item.classList.add('active');
        })
    });    
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*************************!*\
  !*** ./build/js/app.js ***!
  \*************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _nav_scroll_mjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./nav-scroll.mjs */ "./build/js/nav-scroll.mjs");
/* harmony import */ var _mobile_menu_mjs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./mobile-menu.mjs */ "./build/js/mobile-menu.mjs");
// JS Module Imports
// Responsible for the side menu auto scroll and active class on the theme docs page

(0,_nav_scroll_mjs__WEBPACK_IMPORTED_MODULE_0__.navScroll)();
// Responsible for the mobile menu trigger

(0,_mobile_menu_mjs__WEBPACK_IMPORTED_MODULE_1__.mobileMenu)();
})();

/******/ })()
;