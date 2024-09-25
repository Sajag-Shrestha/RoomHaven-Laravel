@extends('backend.includes.main')

<!DOCTYPE html>
<html lang="en">
  <body>
    @section('content')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Edit Room</h3>
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
                  <a href="{{ route('rooms.index') }}">Rooms</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="{{ route('rooms.edit', $room->id) }}">Edit Room</a>
                </li>
              </ul>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Edit Room</h4>
                  </div>
                  <div class="card-body">
                    <!-- Room Editing Form -->
                    <form class="row g-3" method="POST" action="{{ route('rooms.update', $room->id) }}">
                      @csrf
                      @method('PUT')

                      <!-- Room Name -->
                      <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Room Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $room->name) }}" required>
                        @error('name')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Description -->
                      <div class="col-md-12">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ old('description', $room->description) }}</textarea>
                        @error('description')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Image Selection -->
                      <div class="col-md-6">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#imageModal">Select Image</button>
                        <input type="hidden" name="image_id" id="image_id" value="{{ old('image_id', $room->media ? $room->media->id : '') }}">
                      
                        <div id="selectedImagePreview" class="mt-2">
                          <!-- Display the existing selected image -->
                          @if($room->media)
                            <img src="{{ asset('uploads/' . $room->media->img_link) }}" class="img-thumbnail" alt="Selected Image">
                          @else
                            <p>No image selected</p>
                          @endif
                        </div>
                      </div>

                      <!-- Rating -->
                      <div class="col-md-6">
                        <select class="form-select @error('rating') is-invalid @enderror" name="rating" id="rating">
                          <option disabled selected value="">Select Star Rating</option>
                          @for ($i = 1; $i <= 5; $i++)
                              <option value="{{ $i }}" {{ old('rating', $room->rating) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                          @endfor
                        </select>
                        @error('rating')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Capacity -->
                      <div class="col-md-6">
                        <label for="capacity" class="form-label fw-bold">Capacity</label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" id="capacity" value="{{ old('capacity', $room->capacity) }}">
                        @error('capacity')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Room Size -->
                      <div class="col-md-6">
                        <label for="room_size" class="form-label fw-bold">Room Size (m<sup>2</sup>)</label>
                        <input type="number" step="0.1" class="form-control @error('room_size') is-invalid @enderror" name="room_size" id="room_size" value="{{ old('room_size', $room->room_size) }}">
                        @error('room_size')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Price -->
                      <div class="col-md-6">
                        <label for="price" class="form-label fw-bold">Price Per Night</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $room->price) }}" required>
                        @error('price')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="col-md-12 pt-2">
                        <button type="submit" class="btn btn-primary fw-bold">Update Room</button>
                      </div>
                    </form><!-- End Room Editing Form -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Image Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Select Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  @foreach ($images as $image)
                    <div class="col-md-3 mb-3">
                      <div class="card h-100">
                        <label for="image{{ $image->id }}">
                          <img src="{{ asset('uploads/' . $image->img_link) }}" class="card-img-top img-thumbnail" alt="{{ $image->title }}">
                        </label>
                        <div class="card-body text-center">
                          <input type="radio" name="selectedImage" value="{{ $image->id }}" data-img-link="{{ asset('uploads/' . $image->img_link) }}" id="image{{ $image->id }}" {{ $room->image_id == $image->id ? 'checked' : '' }}>
                          <label for="image{{ $image->id }}">{{ $image->title }}</label>
                        </div>
                    </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmImageSelection">Confirm Selection</button>
              </div>
            </div>
          </div>
        </div>

    @endsection

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Handle image selection
        document.getElementById("confirmImageSelection").addEventListener("click", function() {
          const selectedImage = document.querySelector('input[name="selectedImage"]:checked');
          if (selectedImage) {
            const imgLink = selectedImage.getAttribute('data-img-link');
            const imageId = selectedImage.value;

            // Set hidden input value and show the selected image
            document.getElementById('image_id').value = imageId;
            document.getElementById('selectedImagePreview').innerHTML = `<img src="${imgLink}" class="img-thumbnail" alt="Selected Image">`;

            // Close the modal
            const imageModal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
            imageModal.hide();
          }
        });
      });
    </script>

    <style>
      .form-select {
        display: flex;
        align-items: center;
        height: 40.8px; /* Match height of the button */
      }
    </style>
  </body>
</html>
