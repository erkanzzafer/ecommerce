<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.email-setting-update') }}" method="post">
                @csrf
                @method('put')



                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>


</div>
