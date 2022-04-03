<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteLabel">Confirmar ação</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <div type="text" class="form-control" id="recipient-name"></div>
            </div>
        </div>
        <div class="modal-footer">
            <form id="confirmationForm" method="post">
                @csrf
                <input type="hidden" class="form-control" name="anime_name" id="anime_name">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger">Remover</button>
            </form>
        </div>
        </div>
    </div>
</div>