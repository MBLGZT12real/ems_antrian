<?php
$staffPassword = "Seven.777";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $passwordInput = isset($_POST['staff_password']) ? $_POST['staff_password'] : '';

    if (!empty($passwordInput)) {
        if ($passwordInput == $staffPassword) {
            $_SESSION['staff_auth'] = true;
            header("Refresh:0");
            exit;
        } else {
            echo "<script>alert('Password yang anda masukan salah')</script>";
            header("Refresh:0");
            exit;
        }
    } else {
        echo "<script>alert('Password tidak boleh kosong')</script>";
        header("Refresh:0");
        exit;
    }
}
?>
<div class="row">
    <div class="container pt-5">
        <div class="row justify-content-lg-center">
            <div class="col-lg-5 mb-4">
                <div class="px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
                    <div class="d-flex justify-content-center align-items-center me-md-auto">
                        <i class="bi-lock-fill text-success me-3 fs-5"></i>
                        <h1 class="h5 pt-2">Akses Terbatas</h1>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body d-grid p-5">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="staff_password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="staff_password" name="staff_password" placeholder="Password" autofocus>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="bi-unlock-fill me-2 fs-4"></i> Masuk
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
