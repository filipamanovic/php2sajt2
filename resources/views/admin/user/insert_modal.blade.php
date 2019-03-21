<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">New User</h3>
            </div>
            <div class="modal-body">
                <form action="{{route('user.store')}}" method="post">
                    @csrf
                    <p></p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" placeholder="First name" required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" placeholder="Last name" required="required">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tel" placeholder="Contact tel" required="required">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" placeholder="City" required="required">
                    </div>
                    <div class="form-group">
                        <select name="role_id" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->uloga}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="aktivan" class="form-control">
                            <option value="0">Neaktivan nalog</option>
                            <option value="1">Aktivan nalog</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="inComm">Add new user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>