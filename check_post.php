<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: /");
    exit;
}
