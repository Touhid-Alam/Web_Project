<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../model/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../view/login.php");
    exit;
}

$username = $_SESSION['username'];

$db = new mydb();
$conn = $db->openCon();

// Fetch current balance and account details
$balance = $db->getBuyerBalance($username, $conn);
$accountDetails = $db->getBuyerAccountDetails($username, $conn);

$withdrawError = "";

// Handle balance addition
if (isset($_POST['add_balance'])) {
    $addAmount = floatval($_POST['add_amount']);
    if ($addAmount > 0) {
        $db->updateBuyerBalance($username, $addAmount, 'add', $conn);
        header("Location: ../view/manage_balance.php");
        exit;
    } else {
        echo "Invalid amount.";
    }
}

// Handle balance withdrawal
if (isset($_POST['withdraw_balance'])) {
    $withdrawAmount = floatval($_POST['withdraw_amount']);
    if ($withdrawAmount > 0 && $withdrawAmount <= $balance) {
        $db->updateBuyerBalance($username, $withdrawAmount, 'withdraw', $conn);
        header("Location: ../view/manage_balance.php");
        exit;
    } else {
        $withdrawError = "Invalid amount or insufficient balance.";
    }
}

$conn->close();
?>
