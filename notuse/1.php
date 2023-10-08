<form action="login_db.php" method="post">
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                        <h3>
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </h3>
                    </div>
                <?php endif ?>
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" name="username"><br>
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password">
                <button type="submit" name="login_user">เข้าสู่ระบบ</button>

            </form>