@extends('layout.app')
@section('title', 'Update People')

@section('main')
    <div class="container p-4">
        <div class="text-center">
            <h2>Update People: {{ $people->name }}</h2>
        </div>

        <form action="{{ route('people.update', $people->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') ?? $people->name }}"
                    class="form-control rounded-0" placeholder="Name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="province_id">Province</label>
                <select class="form-control rounded-0" name="province_id" id="province_id">
                    @foreach ($provinces as $prov)
                        @if ($prov->id == $people->province_id)
                            <option selected value="{{ $prov->id }}">{{ $prov->id }} - {{ $prov->name }}</option>
                        @else
                            <option value="{{ $prov->id }}">{{ $prov->id }} - {{ $prov->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" name="image" id="avatar" value="{{ old('image') }}"
                    class="form-control rounded-0">
                <div class="img w-25">
                    <img src="/uploads/{{ $people->avatar }}" alt="" class="card-img">
                </div>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-lg-6 form-group">
                    <label for="birthday">Birthday</label>
                    <input type="date" name="birthday" id="birthday" value="{{ old('birthday') ?? $people->birthday }}"
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
                                {{ $people->gender == 1 ? 'checked' : '' }}>
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="gender" value="0"
                                {{ $people->gender == 0 ? 'checked' : '' }}>
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="my-input">About</label>
                <textarea id="my-input" class="form-control rounded-0" type="text" name="about" placeholder="About"
                    rows="5">{{ old('about') ?? $people->about }}</textarea>
                @error('about')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-block btn-outline-secondary rounded-0">Add</button>
        </form>
    </div>
@endsection
