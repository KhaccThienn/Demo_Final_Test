@extends('layout.app')
@section('title', 'Add People')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>Add People</h2>
        </div>

        <form action="{{ route('people.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control rounded-0"
                    placeholder="Name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="province_id">Province</label>
                <select class="form-control rounded-0" name="province_id" id="province_id">
                    @foreach ($provinces as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->id }} - {{ $prov->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" name="image" id="avatar" value="{{ old('image') }}"
                    class="form-control rounded-0">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-lg-6 form-group">
                    <label for="birthday">Birthday</label>
                    <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}"
                        class="form-control rounded-0" placeholder="birthday">
                    @error('birthday')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6 form-group">
                    <label for="birthday">Birthday</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="genderz" value="1"
                                checked>
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="gender" value="0">
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="my-input">About</label>
                <textarea id="my-input" class="form-control rounded-0" type="text" name="about" placeholder="About"
                    rows="5">{{ old('about') }}</textarea>
                @error('about')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-block btn-outline-secondary rounded-0">Add</button>
        </form>
    </div>
@endsection
