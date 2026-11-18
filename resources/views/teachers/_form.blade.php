<form class="teacher-form" action="{{ $teacher->exists ? route('teachers.update', $teacher) : route('teachers.store') }}" method="POST">
    @csrf
    @if ($teacher->exists)
        @method('PUT')
    @endif

    <div class="form-grid">
        <div class="form-field">
            <label for="name">Full name <span class="required-mark">*</span></label>
            <input id="name" name="name" type="text" value="{{ old('name', $teacher->name) }}"
                placeholder="e.g. Maya Chen" maxlength="120" required autofocus>
            @error('name') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-field">
            <label for="subject">Subject <span class="required-mark">*</span></label>
            <input id="subject" name="subject" type="text" value="{{ old('subject', $teacher->subject) }}"
                placeholder="e.g. Mathematics" maxlength="100" required>
            @error('subject') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-field">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $teacher->email) }}"
                placeholder="teacher@school.edu" maxlength="255">
            @error('email') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-field">
            <label for="phone">Phone number</label>
            <input id="phone" name="phone" type="tel" value="{{ old('phone', $teacher->phone) }}"
                placeholder="Optional" maxlength="30">
            @error('phone') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-field">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="active" @selected(old('status', $teacher->status ?: 'active') === 'active')>Active</option>
                <option value="inactive" @selected(old('status', $teacher->status) === 'inactive')>Inactive</option>
            </select>
            @error('status') <span class="field-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-footer">
        <p class="muted"><span class="required-mark">*</span> Required fields</p>
        <div class="form-actions">
            <a class="button button-secondary" href="{{ route('teachers.index') }}">Cancel</a>
            <button class="button button-primary" type="submit">{{ $buttonLabel }}</button>
        </div>
    </div>
</form>
