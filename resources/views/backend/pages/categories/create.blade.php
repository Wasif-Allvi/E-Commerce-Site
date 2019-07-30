  @extends('backend.layouts.master')

  @section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">

        <div class="card-header">

          Add Category

        </div>

        <div class="card-body">

          <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('backend.partials.messages')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Category Name">
              
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control"> </textarea>
            </div>

             <div class="form-group">
              <label for="exampleInputPassword1">Parent Category</label>
              <select class="form-control" name="parent_id">
                <option value="">Please Select a Primary Category</option>
                @foreach($main_categories as $cat)
                <option value="{{$cat->id}}" {{$cat->id == $cat->parent_id ? 'selected' : ''}} >{{$cat->name}}</option>
                @endforeach
              </select>
            </div>

            

            

            <div class="form-group">
              <label for="product_image">Category Image</label>
              

              <input type="file" class="form-control" name="image" id="image">
            </div>

          </div>



          <button type="submit" class="btn btn-primary">Add Category</button>
        </form>


      </div>

    </div>

  </div>
</div>

@endsection