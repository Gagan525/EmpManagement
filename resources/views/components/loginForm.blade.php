<div class="container custom-login">
    <div class="row justify-content-center">
      <div class="text-center p-2">
        <h2 class="bold text-muted">{{$formName}} Login</h2>
      </div>
      @if(session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
      @endif
        <div class="col-md-4 ">
            <form action="{{$action}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
        </div>
    </div>

</div>