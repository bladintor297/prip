    @extends('layouts.app')
    @section('content')
        <div class="container w-75">
            <p class="text-center fs-6 mt-2 fs-1 fw-bold">Tukar Kata Laluan<br></p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <form action="{{ route('update-password', Auth::id()) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="oldPasswordInput" class="form-label">Kata Laluan Semasa</label>
                                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                        placeholder="Kata Laluan Semasa">
                                    @error('old_password')
                                        <span class="text-danger">Ruangan ini mesti disii.</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="newPasswordInput" class="form-label">Kata Laluan Baru</label>
                                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                        placeholder="Kata Laluan Baru">
                                    @error('new_password')
                                        <span class="text-danger">Ruangan ini mesti disii.</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirmNewPasswordInput" class="form-label">Sahkan Kata Laluan Baru</label>
                                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                        placeholder="Sahkan Kata Laluan Baru">
                                </div>
                                <div class="d-flex justify-content-end ">
                                    <button class="btn btn-success fw-bold">Tukar Kata Laluan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection