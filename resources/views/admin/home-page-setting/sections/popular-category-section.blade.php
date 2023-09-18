<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                @method('put')
                <h5>Kategori 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control main-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alt Kategori</label>
                            <select class="form-control sub-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dış Kategori</label>
                            <select class="form-control child-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 1 --}}

                <h5>Kategori 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control main-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alt Kategori</label>
                            <select class="form-control sub-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dış Kategori</label>
                            <select class="form-control child-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 2 --}}


                <h5>Kategori 3</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control main-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alt Kategori</label>
                            <select class="form-control sub-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dış Kategori</label>
                            <select class="form-control child-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 3 --}}

                <h5>Kategori 4</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control main-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Alt Kategori</label>
                            <select class="form-control sub-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dış Kategori</label>
                            <select class="form-control child-category" name="layout" value="">
                                <option value="LTR">Seçiniz</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 4 --}}


                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.sub-category')
                        selector.empty();
                        selector.append('<option >Seçiniz</option>');
                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                })
            })




            //get child category
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                let row=$(this).closest('.row')
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.get-childcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.child-category')
                      //  selector.empty();
                       // selector.append('<option >Seçiniz</option>');
                       selector.html('<option> Seçiniz</option>');
                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                })
            })
        });
    </script>
@endpush
