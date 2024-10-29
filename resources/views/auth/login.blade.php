<x-client-layout>
    <div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light mt-4">Access Account</h3>
                                        <p class="text-center text-body-tertiary">Join us again for seamless tracking!</p>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="/login">
                                            @csrf
                                        
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="inputEmail"
                                                    type="email"
                                                    name="email"
                                                    placeholder="name@example.com"
                                                    value="{{ old('email') }}"
                                                    required
                                                    autocomplete="email"
                                                    autofocus />
                                                <label for="inputEmail">Email address</label>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="inputPassword"
                                                    type="password"
                                                    name="password"
                                                    placeholder="Password"
                                                    required
                                                    autocomplete="current-password" />
                                                <label for="inputPassword">Password</label>

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-check mb-3">
                                                <input
                                                    class="form-check-input"
                                                    id="inputRememberPassword"
                                                    type="checkbox"
                                                    name="remember"
                                                    value="1"
                                                    {{ old('remember') ? 'checked' : '' }} />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small">Forgot Password?</a>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="/register">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-client-layout>