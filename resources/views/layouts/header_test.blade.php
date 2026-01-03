<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JFinserv Admin Panel')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('theme/dist-assets/css/sb-admin-3.css') }}" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style></style>
</head>
<body>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-shield-dollar"></i>
                </div>
                <h2>JFinserv Admin Panel</h2>
            </div>
            
            <nav class="sidebar-nav">
                <a href="#" class="nav-item active" data-page="dashboard">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item" data-page="loan-applications">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Loan Applications</span>
                </a>
                <a href="#" class="nav-item" data-page="users">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="#" class="nav-item" data-page="analytics">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-gift"></i>
                    <span>Loyalty Programs</span>
                </a>
                <a href="#" class="nav-item" data-page="properties">
                    <i class="fas fa-building"></i>
                    <span>Properties</span>
                </a>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <div class="user-name">John Anderson</div>
                        <div class="user-role">Admin</div>
                    </div>
                    <div class="user-menu-container">
                        <button class="user-menu-btn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="user-menu-dropdown">
                            <a href="#" class="user-menu-item" data-action="account">
                                <i class="fas fa-user-circle"></i>
                                Account
                            </a>
                            <a href="#" class="user-menu-item" data-action="logout">
                                <i class="fas fa-sign-out-alt"></i>
                                Log out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
   
     

   <!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard Loaded');

    // =======================
    // Loan Performance Chart
    // =======================
    const loanPerformanceCtx = document.getElementById('loanPerformanceChart');
    if (loanPerformanceCtx) {
        new Chart(loanPerformanceCtx, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun'],
                datasets: [
                    { label:'Disbursed', data:[320,380,420,400,410,420], borderColor:'#3B82F6', backgroundColor:'rgba(59,130,246,0.1)', tension:0.4, fill:true, pointRadius:5 },
                    { label:'Approved', data:[280,340,380,360,370,380], borderColor:'#10b981', backgroundColor:'rgba(16,185,129,0.1)', tension:0.4, fill:true, pointRadius:5 }
                ]
            },
            options: { responsive:true, maintainAspectRatio:false }
        });
    }

    // =======================
    // Loan Status Chart
    // =======================
    const loanStatusCtx = document.getElementById('loanStatusChart');
    if (loanStatusCtx) {
        new Chart(loanStatusCtx, {
            type:'doughnut',
            data:{ labels:['Approved','Pending','Rejected','Closed'], datasets:[{ data:[58,25,12,5], backgroundColor:['#3B82F6','#f59e0b','#ef4444','#94a3b8'] }] },
            options:{ responsive:true, maintainAspectRatio:false }
        });
    }

    // =======================
    // Navigation
    // =======================
    const navItems = document.querySelectorAll('.nav-item[data-page]');
    const pageViews = document.querySelectorAll('.page-view');

    navItems.forEach(item => {
        item.addEventListener('click', function(e){
            e.preventDefault();
            const target = this.getAttribute('data-page');

            navItems.forEach(n => n.classList.remove('active'));
            this.classList.add('active');

            pageViews.forEach(view => view.style.display='none');
            const targetView = document.getElementById(target+'-view');
            if(targetView) targetView.style.display='block';
        });
    });

    // =======================
    // User Menu
    // =======================
    const userMenuBtn = document.querySelector('.user-menu-btn');
    const userMenuDropdown = document.querySelector('.user-menu-dropdown');

    if(userMenuBtn){
        userMenuBtn.addEventListener('click', e=>{
            e.stopPropagation();
            userMenuDropdown.style.display = userMenuDropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', e=>{
            if(!userMenuDropdown.contains(e.target)) userMenuDropdown.style.display='none';
        });

        const menuItems = userMenuDropdown.querySelectorAll('.user-menu-item');
        menuItems.forEach(item=>{
            item.addEventListener('click', e=>{
                e.preventDefault();
                userMenuDropdown.style.display='none';
                if(item.getAttribute('data-action')==='logout') alert('Logout clicked');
                if(item.getAttribute('data-action')==='account') alert('Account clicked');
            });
        });
    }
});
</script>

</body>
</html>
