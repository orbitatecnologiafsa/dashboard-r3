<script src="https://orbitadashboard.azurewebsites.net/js/jquery/jquery-3.6.3.min.js"></script>
<script src="https://orbitadashboard.azurewebsites.net/js/core/popper.min.js"></script>
<script src="https://orbitadashboard.azurewebsites.net/js/core/bootstrap.min.js"></script>
<script src="https://orbitadashboard.azurewebsites.net/js/plugins/perfect-scrollbar.min.js"></script>
<script src="https://orbitadashboard.azurewebsites.net/js/plugins/smooth-scrollbar.min.js"></script>
<script src="https://orbitadashboard.azurewebsites.net/js/plugins/chartjs.min.js"></script>

<script src="https://orbitadashboard.azurewebsites.net/js/sweetalert.min.js"></script>
<script src="https://orbitadashboard.azurewebsites.net/js/dashboard/dashboard.js"></script>

<script async defer>
    nav_info("{{ route('user-ultimo-update') }}")
    // forma_pagamento("{{ route('user-grafico-info') }}")

</script>



<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="https://orbitadashboard.azurewebsites.net/js/argon-dashboard.min.js?v=2.0.4"></script>
