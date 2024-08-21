<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gold Calculator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar:wght@400;700&display=swap"
        rel="stylesheet" />
</head>

<body class="font-['Noto_Sans_Myanmar'] flex items-center justify-center h-screen bg-gradient-to-br from-tan-500 via-white to-sky-100 p-5">
    <div class="w-full max-w-sm p-6 bg-gradient-to-br from-green-400 via-green-300 to-yellow-200 shadow-lg rounded-lg text-blue-800">
        <h1 class="text-3xl text-center text-white mb-6">Gold Calculator</h1>
        <?php
        // Initialize error variables
        $weightError = $salePriceError = $currentPriceError = "";
        $weightInGram = $salePrice = $currentPrice = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['weightInGram'])) {
                $weightError = "ရွှေအလေးချိန်ကို ဂရမ်ဖြင့်တွက်ရန် ဖြည့်ပါ";
            } else {
                $weightInGram = floatval($_POST['weightInGram']);
            }

            if (empty($_POST['salePrice'])) {
                $salePriceError = "ပစ္စည်းတန်ဖိုးကို ဖြည့်ပါ";
            } else {
                $salePrice = floatval($_POST['salePrice']);
            }

            if (empty($_POST['currentPrice'])) {
                $currentPriceError = "ဈေးကွက်ပေါက်ဈေးကို ဖြည့်ပါ";
            } else {
                $currentPrice = floatval($_POST['currentPrice']);
            }
        }
        ?>
        <form id="goldCalculator" method="POST" action="index.php">
            <div>
                <label for="weightInGram" class="block font-bold text-white mt-4"> ရွှေအလေးချိန် (ဂရမ်ဖြင့်) </label>
                <input
                    type="number"
                    id="weightInGram"
                    name="weightInGram"
                    class="w-full p-2 mt-2 border-2 border-yellow-700 rounded shadow-inner bg-white focus:outline-none focus:scale-105 transform transition-transform"
                    value="<?php echo htmlspecialchars($weightInGram); ?>" />
                <?php if ($weightError): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline"><?php echo $weightError; ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label for="salePrice" class="block font-bold text-white mt-4"> ပစ္စည်းတန်ဖိုး (ကျပ်) </label>
                <input
                    type="number"
                    id="salePrice"
                    name="salePrice"
                    class="w-full p-2 mt-2 border-2 border-yellow-700 rounded shadow-inner bg-white focus:outline-none focus:scale-105 transform transition-transform"
                    value="<?php echo htmlspecialchars($salePrice); ?>" />
                <?php if ($salePriceError): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline"><?php echo $salePriceError; ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label for="currentPrice" class="block font-bold text-white mt-4"> ဈေးကွက်ပေါက်ဈေး (ကျပ်) </label>
                <input
                    type="number"
                    id="currentPrice"
                    name="currentPrice"
                    class="w-full p-2 mt-2 border-2 border-yellow-700 rounded shadow-inner bg-white focus:outline-none focus:scale-105 transform transition-transform"
                    value="<?php echo htmlspecialchars($currentPrice); ?>" />
                <?php if ($currentPriceError): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline"><?php echo $currentPriceError; ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <button
                type="submit"
                class="w-full p-4 mt-6 text-black bg-red-400 rounded-lg relative overflow-hidden transition-transform transform hover:scale-105">
                <span class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-green-300 opacity-0 transition-opacity duration-500 hover:opacity-100"></span>
                <span class="text-black-400 relative z-10 ">တွက်မည်</span>
            </button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$weightError && !$salePriceError && !$currentPriceError): ?>
            <div class="mt-8 p-6 bg-gray-100 rounded-lg shadow-lg text-center transition-transform transform hover:-translate-y-1">
                <h2 class="text-xl font-bold text-gray-800 mb-4">ရလဒ်</h2>
                <p class="text-lg mb-2">ရွှေအလေးချိန် <span id="localWeight" class="font-bold text-green-700 bg-yellow-100 px-2 py-1 rounded shadow-inner">
                        <?php
                        $localWeight = $weightInGram / 1.0205;
                        echo number_format($localWeight, 2);
                        ?>
                    </span> ပဲ</p>
                <p class="text-lg mb-2">ရွှေတန်ဖိုး <span id="actualGoldPrice" class="font-bold text-green-700 bg-yellow-100 px-2 py-1 rounded shadow-inner">
                        <?php
                        $actualGoldPrice = $localWeight * ($currentPrice / 16);
                        echo number_format($actualGoldPrice, 2);
                        ?>
                    </span> ကျပ်</p>
                <p class="text-lg mb-2">လက်ခ <span id="serviceCharge" class="font-bold text-green-700 bg-yellow-100 px-2 py-1 rounded shadow-inner">
                        <?php
                        $serviceCharge = $salePrice - $actualGoldPrice;
                        echo number_format($serviceCharge, 2);
                        ?>
                    </span> ကျပ်</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>