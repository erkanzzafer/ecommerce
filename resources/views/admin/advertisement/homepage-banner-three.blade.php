<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
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
