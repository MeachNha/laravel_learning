<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create New User</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="card shadow rounded">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Create New User</h4>
    </div>
    <div class="card-body">
      <form action="{{route('frm.store')}}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Create User</button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS (Optional for features like dropdowns, tooltips) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
