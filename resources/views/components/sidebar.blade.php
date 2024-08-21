<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/" class="b-brand">
                <img src="/assets/images/logo-full.png" alt="" class="logo logo-lg">
                <img src="/assets/images/logo/dora_seo.png" alt="" class="logo logo-sm">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>
                <li class="nxl-item">
                    <a @if( auth()->user()->role == 'admin')
                           href="{{ route('dashboard') }}"
                       @elseif( auth()->user()->role == 'manager')
                           href="{{ route('manager.dashboard') }}"
                       @elseif (auth()->user()->role == 'staff')
                           href="{{ route('staff.dashboard') }}"
                       @endif class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboards</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('contracts.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Contracts</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('buildings.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Obyekti</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('sections.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Seksiya</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('floors.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Etaj</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('employees.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Employees</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('rooms.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Xonalar</span>
                    </a>
                </li>
                <li class="nxl-item">
                    <a href="{{ route('clients.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Client</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal HTML -->
<div class="modal fade" id="branchModal" tabindex="-1" aria-labelledby="branchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="branchModalLabel">Ushbu siyosatni yopish va (x) tugmasini bosishdan avval qaysi amallarni ketma ket qilishingizni eslab qolishingizni so'raymiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" disabled></button>
            </div>
            <div class="modal-body">
                Eslatma
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" disabled>Yopish</button>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function showModal() {
            var messages = [
                "Filial qo'shishingizni so'raymiz.",
                "Xodim qo'shishingizni so'raymiz.",
                "Xona qo'shishingizni so'raymiz.",
                "Client qo'shishingizni so'raymiz.",
                "Shartnoma tuzishingizni so'raymiz."
            ];

            var currentIndex = 0;
            var modal = new bootstrap.Modal(document.getElementById('branchModal'));

            function showModalMessage() {
                var messageWithIndex = (currentIndex + 1) + ". " + messages[currentIndex];
                $('.modal-body').append('<p>' + messageWithIndex + '</p>');
                modal.show();
                currentIndex++;

                if (currentIndex < messages.length) {
                    setTimeout(showModalMessage, 5000);
                } else {
                    setTimeout(function () {
                        modal.hide();
                        $.ajax({
                            url: "{{ route('modal.seen') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    sessionStorage.setItem('admin_modal_shown', 'true');
                                }
                            }
                        });
                    }, 5000);
                }
            }

            setTimeout(function() {
                $('.btn-close, .btn-secondary').removeAttr('disabled');
            }, 10000);

            showModalMessage();
        }

        function checkAndShowModal() {
            if (!sessionStorage.getItem('admin_modal_shown')) {
                $.ajax({
                    url: "{{ route('modal.check') }}",
                    method: "GET",
                    success: function(response) {
                        if (response.show_modal) {
                            showModal();
                        }
                    }
                });
            }
        }

        setInterval(function() {
            sessionStorage.removeItem('admin_modal_shown');
            checkAndShowModal();
        }, 4 * 60 * 60 * 1000);

        checkAndShowModal();
    });

</script>
