// Initialize Loan Performance Chart (Line Chart)
const loanPerformanceCtx = document.getElementById('loanPerformanceChart');
if (loanPerformanceCtx) {
    new Chart(loanPerformanceCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [
                {
                    label: 'Disbursed',
                    data: [320, 380, 420, 400, 410, 420],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#3B82F6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                },
                {
                    label: 'Approved',
                    data: [280, 340, 380, 360, 370, 380],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    },
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 500,
                    ticks: {
                        stepSize: 100,
                        font: {
                            size: 11
                        },
                        color: '#64748b'
                    },
                    grid: {
                        color: '#e2e8f0',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 11
                        },
                        color: '#64748b'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

// Initialize Loan Status Chart (Donut Chart)
const loanStatusCtx = document.getElementById('loanStatusChart');
if (loanStatusCtx) {
    new Chart(loanStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pending', 'Rejected', 'Closed'],
            datasets: [{
                data: [58, 25, 12, 5],
                backgroundColor: [
                    '#3B82F6',
                    '#f59e0b',
                    '#ef4444',
                    '#94a3b8'
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            size: 12
                        },
                        generateLabels: function(chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map((label, i) => {
                                    const value = data.datasets[0].data[i];
                                    return {
                                        text: `${label}: ${value}%`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: data.datasets[0].backgroundColor[i],
                                        lineWidth: 0,
                                        hidden: false,
                                        index: i
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    },
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
}

// Add smooth scroll behavior
document.addEventListener('DOMContentLoaded', function() {
    // Add any additional initialization code here
    console.log('JFinserv Admin Panel Dashboard Loaded');
    
    // Navigation functionality
    initNavigation();
    
    // User menu dropdown
    initUserMenu();
    
    // Settings tab navigation
    initSettingsTabs();
});

// Settings Tab Navigation
function initSettingsTabs() {
    const settingsNavItems = document.querySelectorAll('.settings-nav-item');
    const settingsTabs = document.querySelectorAll('.settings-tab');
    
    settingsNavItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-settings-tab');
            
            // Remove active class from all nav items
            settingsNavItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked nav item
            this.classList.add('active');
            
            // Show target tab
            showSettingsTab(targetTab);
        });
    });
}

function showSettingsTab(tabName) {
    const settingsTabs = document.querySelectorAll('.settings-tab');
    settingsTabs.forEach(tab => {
        tab.style.display = 'none';
        tab.classList.remove('active');
    });
    
    const targetTab = document.getElementById(tabName + '-settings-tab');
    if (targetTab) {
        targetTab.style.display = 'block';
        targetTab.classList.add('active');
    }
}

// Navigation System
function initNavigation() {
    const navItems = document.querySelectorAll('.nav-item[data-page]');
    const pageViews = document.querySelectorAll('.page-view');
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetPage = this.getAttribute('data-page');
            
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked nav item
            this.classList.add('active');
            
            // Hide all page views
            pageViews.forEach(view => {
                view.style.display = 'none';
            });
            
            // Show target page view
            const targetView = document.getElementById(targetPage + '-view');
            if (targetView) {
                targetView.style.display = 'block';
            }
        });
    });
}

// User Menu Dropdown
function initUserMenu() {
    const userMenuBtn = document.querySelector('.user-menu-btn');
    const userMenuContainer = document.querySelector('.user-menu-container');
    const userMenuDropdown = document.querySelector('.user-menu-dropdown');
    
    if (userMenuBtn && userMenuContainer) {
        // Toggle on click
        userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userMenuContainer.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuContainer.contains(e.target)) {
                userMenuContainer.classList.remove('active');
            }
        });
        
        // Close dropdown when clicking on menu items
        if (userMenuDropdown) {
            const menuItems = userMenuDropdown.querySelectorAll('.user-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    userMenuContainer.classList.remove('active');
                    
                    const action = this.getAttribute('data-action');
                    const navItems = document.querySelectorAll('.nav-item[data-page]');
                    const pageViews = document.querySelectorAll('.page-view');
                    
                    if (action === 'logout') {
                        // Handle logout
                        console.log('Logout clicked');
                        alert('Logout functionality - to be implemented');
                    } else if (action === 'account' || action === 'settings') {
                        // Navigate to Settings page
                        // Remove active class from all nav items
                        navItems.forEach(nav => nav.classList.remove('active'));
                        
                        // Hide all page views
                        pageViews.forEach(view => {
                            view.style.display = 'none';
                        });
                        
                        // Show settings view
                        const settingsView = document.getElementById('settings-view');
                        if (settingsView) {
                            settingsView.style.display = 'block';
                            // Show Account tab for Account, or default to Account for Settings
                            if (action === 'account') {
                                showSettingsTab('account');
                            } else if (action === 'settings') {
                                showSettingsTab('account'); // Default to Account tab
                            }
                        }
                    }
                });
            });
        }
    }
}

