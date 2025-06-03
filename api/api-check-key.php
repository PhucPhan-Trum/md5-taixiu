<?php
header('Content-Type: application/json');

$keys = [
  "PP-9X2KD-Q74LV-RW81M-TZJ5C": "2025-06-04",
      "PP-A3XLM-F29GE-W18PY-K7VQD": "2025-06-10",
      "PP-H7V6M-WP5XZ-KF94T-3B2QL": "2025-07-01",
      "PP-NY1QE-JW63M-RZ8KC-L4PVT": "2025-08-01",
      "PP-X93ML-B57KW-Y2VTR-PH6QE": "2025-09-01",
      "PP-Q27VJ-XPM68-LY9CW-TK3ZF": "2025-10-01",
      "PP-MK1YC-R38WP-ZTFX9-L72QJ": "2025-11-01",
      "PP-W46YM-JK9QF-XTV2L-R3BPC": "2025-12-01",
      "PP-B9K4M-Q2XPL-JYW37-TFZCV": "2026-01-01",
      "PP-Z2PTX-KV38L-R4YM9-WQ6JF": "2026-02-01",
      "PP-JL6MP-Y9XQW-KF2ZR-83VTC": "2026-03-01"
];

$data = json_decode(file_get_contents("php://input"), true);
$key = isset($data["key"]) ? $data["key"] : "";

if (!$key || !isset($keys[$key])) {
  echo json_encode(["valid" => false, "error" => "Key không hợp lệ"]);
  exit;
}

$exp = strtotime($keys[$key] . " 23:59:59");
$now = time();

if ($now > $exp) {
  echo json_encode(["valid" => false, "error" => "Key đã hết hạn"]);
  exit;
}

echo json_encode(["valid" => true]);
?>
