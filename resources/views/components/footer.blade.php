<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.3rem;
        color: #007bff;
        /* Bootstrap primary color */
    }

    .card-text strong {
        color: #6c757d;
        /* Bootstrap secondary color */
    }

    .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary color */
        border-color: #007bff;
        /* Bootstrap primary color */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Slightly darker shade of primary color on hover */
        border-color: #0056b3;
        /* Slightly darker shade of primary color on hover */
    }
    .pagination .page-link {
        background-color: #0f172a; /* Black background */
        color: #fff; /* White text */
    }

    .pagination .page-item.active .page-link {
        background-color: #1e293b; /* Slightly lighter black background */
        color: #fff; /* White text */
        border-color: #1e293b; /* Match border color */
    }

    .footer {
        background-color: #f8f9fa; /* Light background color */
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
<main class="nxl-container" style="padding-bottom: 60px;"> <!-- Bottom padding added -->
<footer class="footer">
    <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
        <span>DORA ©</span>
        <!-- End Main Content -->
        <script>
            document.write(new Date().getFullYear());
        </script>
    </p>
    <div class="d-flex align-items-center gap-4">
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>
    </div>
</footer>
</main>