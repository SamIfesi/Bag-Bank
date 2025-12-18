<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="public/assets/css/dash.css">
    <title>D'Bag Bank - Dashboard</title>
</head>

<body class="home-body">
    <header class="home-header flex-space">
        <div class="topbar-left">
            <h2>Hi,
                <span><?php echo htmlspecialchars($user->username); ?></span>
            </h2>
            <p>How are you today?</p>
        </div>

        <div class="topbar-right">
            <button class="reward">
                <i class="ti ti-gift"></i>
                <span>Reward</span>
            </button>
            <button class="notifications">
                <i class="ti ti-bell"></i>
            </button>
        </div>
    </header>