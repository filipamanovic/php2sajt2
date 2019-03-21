<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('productUpdate')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p></p>
                    <div class="form-group">
                        <label class="formaUnos">Product name:</label>
                        <input type="text" class="form-control" name="productName" id="upName" required="required">
                    </div>
                    <div class="form-group">
                        <label class="formaUnos">Product description:</label>
                        <textarea rows="6" class="form-control" name="productDesc" id="upDesc" required="required"> </textarea>
                    </div>
                    <div class="form-group">
                        <label class="formaUnos">Product price in &euro;:</label>
                        <input type="text" class="form-control" name="productPrice" id="upPrice" required="required">
                    </div>
                    <div class="form-group">
                        <label class="formaUnos">Change image:</label>
                        <input type="file" class="form-control" name="productImage" id="upImage">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="proizvodId" id="upProizvod" required="required">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="imageId" id="imageId" required="required">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="csrfToken" id="csrfToken" required="required" value="{{csrf_token()}}">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="upProduct">Update product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>