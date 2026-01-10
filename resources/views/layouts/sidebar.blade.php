
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@php
    $role_id = session()->get('role_id');
@endphp
<style>/* ===== SIDEBAR NAV ===== */
.sidebar-nav .nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 18px;
    border-radius: 10px;
    color: #374151;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

/* Hover */
.sidebar-nav .nav-item:hover {
    background: #eef2ff;
    color: #1e40af;
}

/* Active (optional) */
.sidebar-nav .nav-item.active {
    background: #3B82F6;
    color: #ffffff;
}

/* Icons */
.sidebar-nav .nav-item i {
    font-size: 16px;
}
</style>
<aside class="sidebar">

    <div class="sidebar-header">
        <div class="logo">
            <i class="fas fa-shield-dollar"></i>
        </div>
        <h2>JFinserv Admin Panel</h2>
    </div>

    <nav class="sidebar-nav">

        {{-- ================= DASHBOARD ================= --}}
        @if($role_id == 4)
            <a href="{{ route('dashboard') }}" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        @elseif($role_id == 2)
            <a href="{{ route('agentDashboard') }}" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Agent Dashboard</span>
            </a>
        @elseif($role_id == env('partnerRole_id'))
            <a href="{{ route('partnerDashboard') }}" class="nav-item">
                <i class="fas fa-home"></i>
                <span>CP Dashboard</span>
            </a>
        @endif

        {{-- ================= LOANS ================= --}}
        @if($role_id == 4 || $role_id == 2 || $role_id == env('brokerRole_id'))
            <a href="{{ route('admin.loans') }}" class="nav-item">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Loan Applications</span>
            </a>
        @endif

        {{-- ================= PROPERTY ================= --}}
        @if($role_id == 4 || $role_id == 2 || $role_id == env('partnerRole_id'))
            <a href="{{ route('allProperties') }}" class="nav-item">
                <i class="fas fa-building"></i>
                <span>Property</span>
            </a>
        @endif

        {{-- ================= USERS ================= --}}
        @if($role_id == 4)
            <a href="{{ route('admin.customers') }}" class="nav-item">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
        @endif

        {{-- ================= WEB FORM & LEADS (ADDED) ================= --}}
        @if($role_id == 4)
            <a href="{{ route('admin.listlead') }}" class="nav-item">
                <i class="fas fa-tasks"></i>
                <span>Web Form & Leads</span>
            </a>
        @endif

        {{-- ================= TOOLS (ADDED) ================= --}}
        @if($role_id == 4)
            <a href="{{ route('admin.bank') }}" class="nav-item">
                <i class="fas fa-wrench"></i>
                <span>Tools</span>
            </a>
        @endif

        {{-- ================= MLM (ADDED) ================= --}}
        @if($role_id == 4)
            <a href="{{ route('admin.tree.show') }}" class="nav-item">
                <i class="fas fa-project-diagram"></i>
                <span>MLM</span>
            </a>
        @endif
<<<<<<< HEAD
        {{-- ================= COMMISSION ================= --}}
@if($role_id == 4)
    <a href="{{ route('allCommission') }}" class="nav-item">
        <i class="fas fa-coins"></i>
        <span>Commission</span>
    </a>
@endif

=======
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa

    </nav>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-info">
                <div class="user-name">{{ session('username') }}</div>
                <div class="user-role">
                    {{ $role_id == 4 ? 'Admin' : ($role_id == 2 ? 'Agent' : 'Partner') }}
                </div>
            </div>
        </div>
    </div>

</aside>


<!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('theme') }}/dist-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('theme') }}/dist-assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('theme') }}/dist-assets/js/sb-admin-2.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
        <!-- Summernote CSS -->
        <!-- Include CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script><!-- Summernote CSS -->
        <!-- Include CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
        <script>
            $("document").ready(function() {

                var zone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                console.log(zone);
                // $("#currentTimezone").val(zone);
            });
        </script>

        <script>
            $(document).ready(function() {
                // Mark notification as read when clicked
                $(document).on('click', '#notification-list a.notification-item', function(e) {
                    e.preventDefault();
                    var notificationId = $(this).data('id');
                    var url = $(this).attr('href');

                    // Mark as read via AJAX
                    $.ajax({
                        url: '/notifications/mark-as-read/' + notificationId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            if (url !== '#') {
                                window.location.href = url;
                            } else {
                                $(this).removeClass('unread-notification');
                                updateNotificationCount();
                            }
                        }.bind(this)
                    });
                });

                // Mark all notifications as read
                $('#mark-all-notifications-read').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/notifications/mark-all-read',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            $('.unread-notification').removeClass('unread-notification');
                            updateNotificationCount();
                            $('#notification-header').text('No new notifications');
                        }
                    });
                });

                // Function to update notification count
                function updateNotificationCount() {
                    $.get('/notifications/unread-count', function(data) {
                        $('#notification-count').text(data.count);
                        if (data.count > 0) {
                            $('#notification-header').text('You have ' + data.count + ' new notifications');
                        } else {
                            $('#notification-header').text('No new notifications');
                        }
                    });
                }

                // Optional: Poll for new notifications every 30 seconds
                setInterval(updateNotificationCount, 30000);
            });
        </script>


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

        @yield('script')
          @stack('scripts')


          

<!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('theme') }}/dist-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('theme') }}/dist-assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('theme') }}/dist-assets/js/sb-admin-2.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
        <!-- Summernote CSS -->
        <!-- Include CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script><!-- Summernote CSS -->
        <!-- Include CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
        <script>
            $("document").ready(function() {

                var zone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                console.log(zone);
                // $("#currentTimezone").val(zone);
            });
        </script>

        <script>
            $(document).ready(function() {
                // Mark notification as read when clicked
                $(document).on('click', '#notification-list a.notification-item', function(e) {
                    e.preventDefault();
                    var notificationId = $(this).data('id');
                    var url = $(this).attr('href');

                    // Mark as read via AJAX
                    $.ajax({
                        url: '/notifications/mark-as-read/' + notificationId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            if (url !== '#') {
                                window.location.href = url;
                            } else {
                                $(this).removeClass('unread-notification');
                                updateNotificationCount();
                            }
                        }.bind(this)
                    });
                });

                // Mark all notifications as read
                $('#mark-all-notifications-read').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: '/notifications/mark-all-read',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            $('.unread-notification').removeClass('unread-notification');
                            updateNotificationCount();
                            $('#notification-header').text('No new notifications');
                        }
                    });
                });

                // Function to update notification count
                function updateNotificationCount() {
                    $.get('/notifications/unread-count', function(data) {
                        $('#notification-count').text(data.count);
                        if (data.count > 0) {
                            $('#notification-header').text('You have ' + data.count + ' new notifications');
                        } else {
                            $('#notification-header').text('No new notifications');
                        }
                    });
                }

                // Optional: Poll for new notifications every 30 seconds
                setInterval(updateNotificationCount, 30000);
            });
        </script>


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

        @yield('script')
          @stack('scripts')


          