/**
 * RCG Theme - Scripts principaux
 *
 * Animations et interactions front-end.
 */
(function () {
    'use strict';

    function init() {

    /**
     * Navbar : ajouter une ombre au scroll
     */
    var nav = document.querySelector('nav.sticky');
    if (nav) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 10) {
                nav.classList.add('shadow-md');
            } else {
                nav.classList.remove('shadow-md');
            }
        });
    }

    /**
     * Smooth scroll pour les ancres internes
     */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;

            var target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
            }
        });
    });

    /**
     * Animation au scroll (fade-in) - IntersectionObserver
     */
    if ('IntersectionObserver' in window) {
        var revealElements = document.querySelectorAll('.reveal');
        var revealObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1 }
        );

        revealElements.forEach(function (el) {
            revealObserver.observe(el);
        });

        // Fallback for sections without .reveal class
        var animElements = document.querySelectorAll('section:not(.reveal)');
        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1 }
        );

        animElements.forEach(function (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }

    /**
     * Filtrage des realisations par categorie
     */
    var filterBar = document.getElementById('filter-bar');
    var casesGrid = document.getElementById('cases-grid');
    var noResults = document.getElementById('no-results');

    if (filterBar && casesGrid) {
        var filterBtns = filterBar.querySelectorAll('.filter-btn');
        var caseItems = casesGrid.querySelectorAll('.case-item');

        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var filter = this.getAttribute('data-filter');

                // Update active button
                filterBtns.forEach(function (b) {
                    b.classList.remove('active');
                });
                this.classList.add('active');

                // Filter cards
                var visibleCount = 0;
                caseItems.forEach(function (card) {
                    var cat = card.getAttribute('data-cat');
                    if (filter === 'all' || cat === filter) {
                        card.classList.remove('hidden-card');
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.classList.add('hidden-card');
                        card.style.display = 'none';
                    }
                });

                // Show/hide no-results message
                if (noResults) {
                    if (visibleCount === 0) {
                        noResults.classList.remove('hidden');
                    } else {
                        noResults.classList.add('hidden');
                    }
                }
            });
        });
    }
    /**
     * Insights : filtrage par categorie (filter-tab)
     */
    var insightsFilterBar = document.getElementById('insights-filter-bar');
    var insightsGrid = document.getElementById('insights-grid');

    if (insightsFilterBar && insightsGrid) {
        var filterTabs = insightsFilterBar.querySelectorAll('.filter-tab');
        var articleCards = insightsGrid.querySelectorAll('.article-card');

        filterTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var filter = this.getAttribute('data-filter');

                // Update active tab
                filterTabs.forEach(function (t) {
                    t.classList.remove('active');
                });
                this.classList.add('active');

                // Filter articles
                articleCards.forEach(function (card) {
                    var cat = card.getAttribute('data-cat');
                    if (filter === 'all' || cat === filter) {
                        card.style.display = '';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    /**
     * Ticker : pause au survol
     */
    var tickerInner = document.querySelector('.ticker-inner');
    if (tickerInner) {
        var tickerContainer = tickerInner.parentElement;
        if (tickerContainer) {
            tickerContainer.addEventListener('mouseenter', function () {
                tickerInner.style.animationPlayState = 'paused';
            });
            tickerContainer.addEventListener('mouseleave', function () {
                tickerInner.style.animationPlayState = 'running';
            });
        }
    }

    } // end init()

    // Attendre que le DOM soit pret
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
