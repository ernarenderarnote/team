@if(session()->has("error"))
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger">
        <strong>Danger!</strong> {{ session()->get("error") }}
      </div>
    </div>
  </div>
</div>
@endif