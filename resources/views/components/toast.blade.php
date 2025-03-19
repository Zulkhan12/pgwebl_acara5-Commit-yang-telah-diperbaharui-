@if (session()->has('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="LiveToastSuccess" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastLive = document.getElementById('LiveToastSuccess');
            var toast = new bootstrap.Toast(toastLive);
            toast.show();
        });
    </script>
@endif

@if (session()->has('error'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="LiveToastError" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastLive = document.getElementById('LiveToastError');
            var toast = new bootstrap.Toast(toastLive);
            toast.show();
        });
    </script>
@endif

@if ($errors->any())
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="LiveToastError" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastLive = document.getElementById('LiveToastError');
            var toast = new bootstrap.Toast(toastLive);
            toast.show();
        });
    </script>
@endif


