@extends('backend.includes.main')

<!DOCTYPE html>
<html lang="en">
  <body>
    @section('content')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Media</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="{{ route('media.index') }}">Media</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="{{ route('media.create') }}">Add Image</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Add Image</h4>
                  </div>
                  <div class="card-body">
                    <!-- Image Upload Form -->
                    <form class="row g-3" method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data">
                      @csrf
                      @method('post')

                      <!-- Title -->
                      <div class="col-md-6">
                        <label for="title" class="form-label fw-bold">Image Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Image Upload -->
                      <div class="col-md-6">
                        <label for="img_link" class="form-label fw-bold">Upload Image</label>
                        <input type="file" class="form-control @error('img_link') is-invalid @enderror" name="img_link" id="img_link" accept="image/*">
                        @error('img_link')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="col-md-12 pt-2">
                        <button type="submit" class="btn btn-primary fw-bold">Add Image</button>
                      </div>
                    </form><!-- End Image Upload Form -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endsection
  </body>
</html>
