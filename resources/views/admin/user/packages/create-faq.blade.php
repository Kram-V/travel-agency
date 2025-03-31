@extends('admin.layout.master')

@section('content')
  @include('admin.layout.nav')
  @include('admin.layout.sidebar')

  <div class="main-content">
      <section class="section">
          <div class="section-header justify-content-between">
              <h1>Videos of {{ $package->name }}</h1>
              <div class="ml-auto">
                  <a href="{{ route('admin_packages_index') }}">Back to listing</a>
              </div>
          </div>
          <div class="section-body">
              <div class="row">
                  <div class="col-md-4">
                      <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_packages_store_faq', $package->id) }}" method="POST"> 
                                @csrf
                                <div class="row">
                                  <div class="mb-3 form-group col-md-12">
                                    <label class="form-label">Question *</label>
                                    <input type="text" class="form-control" name="question" value="{{ old('question') }}">
                                  </div>

                                  <div class="mb-3 form-group col-md-12">
                                    <label class="form-label">Answer *</label>              
                                    <textarea name="answer" cols="30" rows="10" class="form-control h_100">{{ old('answer') }}</textarea>
                                  </div>

                                  <div class="mb-4">
                                      <button type="submit">Create</button>
                                  </div>
                                </div>
                        
                            </form>
                        </div>
                      </div>
                  </div>

                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($package_faqs as $package_faq)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $package_faq->question }}</td>     
                                      <td>{{ $package_faq->answer }}</td>          
                                      <td class="pt_10 pb_10">
                                          <form action="{{ route('admin_packages_delete_faq', $package_faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                      </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
          </div>
      </section>
  </div>
@endsection