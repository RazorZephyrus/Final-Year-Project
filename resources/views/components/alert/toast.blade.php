<div class="toast bg-primary" id="toast-response-crud" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 2rem; right: 2rem; z-index: 1076">
    <div class="toast-header mb-0 pb-0">
        <div class="w-100 d-flex align-items-center justify-content-between">
            <div class="fw-bold">
                Message!
            </div>
            <div data-dismiss="toast" aria-label="Close">
                <i class="bx bx-x"></i>
            </div>
        </div>
    </div>
    <div class="toast-body">
        {{ session()->get('success_message') }}
    </div>
</div>
