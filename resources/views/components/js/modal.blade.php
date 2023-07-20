<div class="d-none">
    <button data-bs-toggle="modal" id="{{ $id }}-btn" data-bs-target="#{{ $id }}">Open  Modal</button>
</div>
<script>
    document.addEventListener(
        "DOMContentLoaded",
        function() {
            document.getElementById('{{ $id }}-btn').click();
        },
        false
    );
</script>
