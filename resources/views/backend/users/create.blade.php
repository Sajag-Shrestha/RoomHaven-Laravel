@extends('backend.includes.main')

<!DOCTYPE html>
<html lang="en">
  <body>
    @section('content')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Users</h3>
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
                  <a href="{{ route('users.index') }}">Users</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="{{ route('users.index') }}">Add User</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Add User</h4>
                  </div>
                  <div class="card-body">
                    <!-- Multi Columns Form -->
                    <form class="row g-3" method="POST" action="{{ route('users.store') }}">
                      @csrf
                      @method('post')
                      <!-- Name -->
                      <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Your Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Email -->
                      <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" autocomplete="email" value="{{ old('email') }}">
                        @error('email')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <!-- Username -->
                      <div class="col-md-6">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" autocomplete="username" value="{{ old('username') }}">
                        @error('username')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>


                      <!-- Password -->
                      <div class="col-md-6">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                        @error('password')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      
                      <!-- Role -->
                      <div class="col-md-6">
                        <label for="role" class="form-label fw-bold">User Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="Guest" {{ old('role') == 'Guest' ? 'selected' : '' }}>Guest</option>
                          <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
                          <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="col-md-12 pt-2">
                        <button type="submit" class="btn btn-primary fw-bold">Add User</button>
                      </div>
                    </form><!-- End Multi Columns Form -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endsection
  </body>
</html>
