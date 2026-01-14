@section('title', 'home')

<!doctype html>
<html lang="en" class="preset-hrm" class="preset-ai" data-pc-direction="ltr" dir="ltr" data-pc-theme="light">
  <!-- [Head] start -->
  <head>
    <title>HRM | SaasAble Tailwind Multipurpose UI Kit</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Ready-to-use HRM landing page template to help you launch your project faster and smarter." />
    <meta name="keywords" content="Tailwind Templates, Tailwind Theme, SaaS UI Kit, SaaS Template"/>
    <meta name="author" content="Phoenixcoded" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="../assets/fonts/satoshi/Satoshi.css">
    <link rel="stylesheet" href="../assets/fonts/uncut-sans/Uncut-Sans.css">
    <!-- [Font] Family -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="../assets/fonts/phosphor/duotone/style.css" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/material.css" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" />

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg fixed inset-0 bg-theme-bg-default z-[1034] flex items-center justify-center">
       <div class="w-[65px] h-[65px] rounded-full bg-primary-100 flex items-center justify-center absolute">
         <!-- [ Logo icon ] start -->
         <svg class="w-[20px] sm:w-[22px] md:w-[24px] h-auto text-primary-500" viewBox="0 0 37 40" fill="none" xmlns="http://www.w3.org/2000/svg">
           <path
             fillRule="evenodd"
             clipRule="evenodd"
             d="M29.0507 0.657088C32.9601 -1.47888 37.5881 1.90736 36.7407 6.28379L31.081 35.5123C31.0417 35.7758 30.9823 36.0375 30.9023 36.2952C30.7256 36.8969 30.4697 37.3981 30.1515 37.802L30.1236 37.8405C28.4079 40.1894 25.1144 40.7015 22.7675 38.9843C21.6036 38.1327 20.8911 36.8926 20.6777 35.5724L20.6789 35.5732C20.0277 33.124 20.9582 26.5495 25.8412 16.0258L27.7227 18.1367L30.214 7.96335C30.3258 7.50659 29.8291 7.14315 29.4282 7.3884L20.4986 12.8509L23.1853 14.0825C18.1195 19.426 11.0662 24.4251 6.06551 24.9519C4.81627 25.0835 3.32109 24.7555 2.15767 23.9042C-0.18924 22.187 -0.700904 18.8907 1.01484 16.5418L1.02814 16.5237L1.0433 16.5032C1.33101 16.0776 1.73015 15.6819 2.24875 15.3311C2.4702 15.1762 2.70184 15.0398 2.9413 14.9222L29.0507 0.657088ZM9.83615 35.6327C11.3428 36.7129 13.4456 36.3571 14.5329 34.8379C15.2554 33.8285 15.7862 30.5405 16.0612 28.4476C16.1668 27.6438 15.3569 27.0632 14.6305 27.4219C12.739 28.3558 9.79931 29.9167 9.07685 30.9261C7.98955 32.4453 8.3295 34.5525 9.83615 35.6327Z"
             fill="currentColor"
           />
         </svg>
       </div>
       <div class="inline-block border-8 border-dotted absolute border-primary-500 rounded-full size-[100px] animate-[dotAnimation_6s_linear_infinite]" role="status"><span class="sr-only">Loading...</span></div>
       <div class="inline-block border-8 border-primary-500 rounded-full size-[100px] animate-[rotateAnimation_35s_linear_infinite] border-t-transparent dark:border-t-transparent" role="status"><span class="sr-only">Loading...</span></div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Nav ] start -->
    <nav class="z-50 w-full relative bg-neutral-200">
      <div class="container">
        <div class="static flex py-4 items-center justify-between">
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-between">
            <div class="flex flex-1 flex-shrink-0 items-center justify-between text-primary-500">
              <a href="#">
                <!-- [ Logo main ] start -->
                <svg class="w-[112px] lg:w-[140px] h-auto" viewBox="0 0 140 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M18.8829 0.427107C21.4241 -0.961272 24.4323 1.23978 23.8814 4.08446L20.2026 23.083C20.1771 23.2543 20.1385 23.4244 20.0865 23.5919C19.9716 23.983 19.8053 24.3088 19.5985 24.5713L19.5803 24.5963C18.4651 26.1231 16.3244 26.456 14.7989 25.3398C14.0423 24.7862 13.5792 23.9802 13.4405 23.1221L13.4413 23.1226C13.018 21.5306 13.6228 17.2572 16.7968 10.4168L18.0197 11.7888L19.6391 5.17618C19.7118 4.87928 19.3889 4.64305 19.1283 4.80246L13.3241 8.35306L15.0704 9.15363C11.7777 12.6269 7.19306 15.8763 3.94258 16.2187C3.13058 16.3043 2.15871 16.0911 1.40248 15.5377C-0.123006 14.4215 -0.455588 12.279 0.659645 10.7522L0.66829 10.7404L0.678147 10.7271C0.865156 10.4504 1.1246 10.1932 1.46169 9.96519C1.60563 9.86452 1.75619 9.77586 1.91185 9.69943L18.8829 0.427107ZM6.39334 23.161C7.37266 23.8631 8.73948 23.6318 9.44623 22.6444C9.91583 21.9883 10.2609 19.8511 10.4396 18.4907C10.5082 17.9682 9.98185 17.5908 9.50966 17.8239C8.28019 18.431 6.36939 19.4456 5.8998 20.1017C5.19305 21.0891 5.41402 22.4588 6.39334 23.161Z"
                    fill="currentColor"
                  />
                  <path
                    d="M38.1793 21.288C37.2193 21.288 36.3073 21.192 35.4433 21C34.5793 20.808 33.8113 20.504 33.1393 20.088C32.4833 19.656 31.9633 19.12 31.5793 18.48C31.2113 17.824 31.0273 17.032 31.0273 16.104C31.0273 16.024 31.0273 15.944 31.0273 15.864C31.0273 15.768 31.0353 15.696 31.0513 15.648H34.6033C34.5873 15.696 34.5793 15.76 34.5793 15.84C34.5793 15.92 34.5793 15.992 34.5793 16.056C34.5793 16.568 34.7153 17 34.9873 17.352C35.2753 17.704 35.6913 17.968 36.2353 18.144C36.7793 18.32 37.4113 18.408 38.1313 18.408C38.5953 18.408 39.0033 18.384 39.3553 18.336C39.7233 18.272 40.0433 18.192 40.3153 18.096C40.6033 17.984 40.8353 17.856 41.0113 17.712C41.2033 17.568 41.3393 17.4 41.4193 17.208C41.5153 17.016 41.5633 16.8 41.5633 16.56C41.5633 16.128 41.4193 15.776 41.1313 15.504C40.8593 15.232 40.4753 15 39.9793 14.808C39.4993 14.616 38.9553 14.44 38.3473 14.28C37.7393 14.12 37.1153 13.96 36.4753 13.8C35.8353 13.624 35.2113 13.416 34.6033 13.176C33.9953 12.92 33.4513 12.616 32.9713 12.264C32.4913 11.912 32.1073 11.464 31.8193 10.92C31.5313 10.376 31.3873 9.72 31.3873 8.952C31.3873 8.136 31.5553 7.432 31.8913 6.84C32.2433 6.248 32.7313 5.76 33.3553 5.376C33.9793 4.992 34.6993 4.712 35.5153 4.536C36.3313 4.344 37.2193 4.248 38.1793 4.248C39.0753 4.248 39.9233 4.344 40.7233 4.536C41.5233 4.712 42.2273 5 42.8353 5.4C43.4433 5.8 43.9153 6.304 44.2513 6.912C44.6033 7.52 44.7793 8.24 44.7793 9.072V9.36H41.2993V9.168C41.2993 8.736 41.1713 8.368 40.9153 8.064C40.6593 7.76 40.2993 7.52 39.8353 7.344C39.3713 7.168 38.8273 7.08 38.2033 7.08C37.5313 7.08 36.9553 7.144 36.4753 7.272C36.0113 7.4 35.6513 7.592 35.3953 7.848C35.1553 8.088 35.0353 8.376 35.0353 8.712C35.0353 9.096 35.1713 9.416 35.4433 9.672C35.7313 9.912 36.1153 10.128 36.5953 10.32C37.0913 10.496 37.6433 10.656 38.2513 10.8C38.8593 10.944 39.4833 11.104 40.1233 11.28C40.7633 11.456 41.3873 11.664 41.9953 11.904C42.6033 12.144 43.1473 12.448 43.6273 12.816C44.1073 13.168 44.4913 13.608 44.7793 14.136C45.0673 14.664 45.2113 15.296 45.2113 16.032C45.2113 17.296 44.9073 18.312 44.2993 19.08C43.6913 19.848 42.8593 20.408 41.8033 20.76C40.7473 21.112 39.5393 21.288 38.1793 21.288ZM51.1083 21.288C50.6923 21.288 50.2443 21.24 49.7643 21.144C49.3003 21.048 48.8603 20.88 48.4443 20.64C48.0283 20.384 47.6843 20.024 47.4123 19.56C47.1563 19.08 47.0283 18.472 47.0283 17.736C47.0283 16.856 47.2203 16.128 47.6043 15.552C47.9883 14.976 48.5323 14.528 49.2363 14.208C49.9563 13.872 50.8123 13.64 51.8043 13.512C52.7963 13.384 53.8923 13.32 55.0923 13.32V12.384C55.0923 12.016 55.0283 11.696 54.9003 11.424C54.7883 11.152 54.5803 10.936 54.2763 10.776C53.9883 10.616 53.5803 10.536 53.0523 10.536C52.5243 10.536 52.0923 10.6 51.7563 10.728C51.4363 10.856 51.2043 11.024 51.0603 11.232C50.9323 11.424 50.8683 11.64 50.8683 11.88V12.168H47.6283C47.6123 12.088 47.6043 12.016 47.6043 11.952C47.6043 11.872 47.6043 11.776 47.6043 11.664C47.6043 10.928 47.8283 10.296 48.2763 9.768C48.7243 9.224 49.3563 8.808 50.1723 8.52C50.9883 8.232 51.9403 8.088 53.0283 8.088C54.1963 8.088 55.1723 8.24 55.9563 8.544C56.7563 8.848 57.3643 9.296 57.7803 9.888C58.2123 10.48 58.4283 11.224 58.4283 12.12V17.856C58.4283 18.144 58.5083 18.36 58.6683 18.504C58.8443 18.632 59.0363 18.696 59.2443 18.696H60.0363V20.88C59.8763 20.96 59.6283 21.04 59.2923 21.12C58.9563 21.216 58.5483 21.264 58.0683 21.264C57.6043 21.264 57.1883 21.192 56.8203 21.048C56.4683 20.92 56.1723 20.736 55.9323 20.496C55.6923 20.24 55.5243 19.936 55.4283 19.584H55.2603C54.9883 19.92 54.6523 20.216 54.2523 20.472C53.8683 20.728 53.4123 20.928 52.8843 21.072C52.3723 21.216 51.7803 21.288 51.1083 21.288ZM52.2363 18.768C52.6843 18.768 53.0843 18.704 53.4363 18.576C53.7883 18.432 54.0843 18.248 54.3243 18.024C54.5643 17.784 54.7483 17.496 54.8763 17.16C55.0203 16.824 55.0923 16.464 55.0923 16.08V15.384C54.1963 15.384 53.3963 15.448 52.6923 15.576C51.9883 15.688 51.4283 15.888 51.0123 16.176C50.6123 16.464 50.4123 16.864 50.4123 17.376C50.4123 17.664 50.4843 17.912 50.6283 18.12C50.7723 18.328 50.9803 18.488 51.2523 18.6C51.5243 18.712 51.8523 18.768 52.2363 18.768ZM65.0302 21.288C64.6142 21.288 64.1662 21.24 63.6862 21.144C63.2222 21.048 62.7822 20.88 62.3662 20.64C61.9502 20.384 61.6062 20.024 61.3342 19.56C61.0782 19.08 60.9502 18.472 60.9502 17.736C60.9502 16.856 61.1422 16.128 61.5262 15.552C61.9102 14.976 62.4542 14.528 63.1582 14.208C63.8782 13.872 64.7342 13.64 65.7262 13.512C66.7182 13.384 67.8142 13.32 69.0142 13.32V12.384C69.0142 12.016 68.9502 11.696 68.8222 11.424C68.7102 11.152 68.5022 10.936 68.1982 10.776C67.9102 10.616 67.5022 10.536 66.9742 10.536C66.4462 10.536 66.0142 10.6 65.6782 10.728C65.3582 10.856 65.1262 11.024 64.9822 11.232C64.8542 11.424 64.7902 11.64 64.7902 11.88V12.168H61.5502C61.5342 12.088 61.5262 12.016 61.5262 11.952C61.5262 11.872 61.5262 11.776 61.5262 11.664C61.5262 10.928 61.7502 10.296 62.1982 9.768C62.6462 9.224 63.2782 8.808 64.0942 8.52C64.9102 8.232 65.8622 8.088 66.9502 8.088C68.1182 8.088 69.0942 8.24 69.8782 8.544C70.6782 8.848 71.2862 9.296 71.7022 9.888C72.1342 10.48 72.3502 11.224 72.3502 12.12V17.856C72.3502 18.144 72.4302 18.36 72.5902 18.504C72.7662 18.632 72.9582 18.696 73.1662 18.696H73.9582V20.88C73.7982 20.96 73.5502 21.04 73.2142 21.12C72.8782 21.216 72.4702 21.264 71.9902 21.264C71.5262 21.264 71.1102 21.192 70.7422 21.048C70.3902 20.92 70.0942 20.736 69.8542 20.496C69.6142 20.24 69.4462 19.936 69.3502 19.584H69.1822C68.9102 19.92 68.5742 20.216 68.1742 20.472C67.7902 20.728 67.3342 20.928 66.8062 21.072C66.2942 21.216 65.7022 21.288 65.0302 21.288ZM66.1582 18.768C66.6062 18.768 67.0062 18.704 67.3582 18.576C67.7102 18.432 68.0062 18.248 68.2462 18.024C68.4862 17.784 68.6702 17.496 68.7982 17.16C68.9422 16.824 69.0142 16.464 69.0142 16.08V15.384C68.1182 15.384 67.3182 15.448 66.6142 15.576C65.9102 15.688 65.3502 15.888 64.9342 16.176C64.5342 16.464 64.3342 16.864 64.3342 17.376C64.3342 17.664 64.4062 17.912 64.5502 18.12C64.6942 18.328 64.9022 18.488 65.1742 18.6C65.4462 18.712 65.7742 18.768 66.1582 18.768ZM80.7281 21.288C79.8481 21.288 79.0561 21.192 78.3521 21C77.6481 20.808 77.0481 20.544 76.5521 20.208C76.0561 19.856 75.6721 19.44 75.4001 18.96C75.1441 18.48 75.0161 17.936 75.0161 17.328C75.0161 17.264 75.0161 17.2 75.0161 17.136C75.0161 17.072 75.0241 17.024 75.0401 16.992H78.2561C78.2561 17.024 78.2561 17.056 78.2561 17.088C78.2561 17.12 78.2561 17.152 78.2561 17.184C78.2721 17.584 78.4001 17.912 78.6401 18.168C78.8801 18.408 79.1921 18.584 79.5761 18.696C79.9761 18.808 80.3921 18.864 80.8241 18.864C81.2081 18.864 81.5761 18.832 81.9281 18.768C82.2961 18.688 82.6001 18.552 82.8401 18.36C83.0961 18.168 83.2241 17.92 83.2241 17.616C83.2241 17.232 83.0641 16.936 82.7441 16.728C82.4401 16.52 82.0321 16.352 81.5201 16.224C81.0241 16.096 80.4801 15.952 79.8881 15.792C79.3441 15.664 78.8001 15.52 78.2561 15.36C77.7121 15.184 77.2161 14.96 76.7681 14.688C76.3361 14.416 75.9841 14.064 75.7121 13.632C75.4401 13.184 75.3041 12.624 75.3041 11.952C75.3041 11.296 75.4481 10.728 75.7361 10.248C76.0241 9.752 76.4161 9.344 76.9121 9.024C77.4241 8.704 78.0161 8.472 78.6881 8.328C79.3761 8.168 80.1121 8.088 80.8961 8.088C81.6321 8.088 82.3201 8.168 82.9601 8.328C83.6001 8.472 84.1601 8.696 84.6401 9C85.1201 9.288 85.4961 9.656 85.7681 10.104C86.0401 10.536 86.1761 11.024 86.1761 11.568C86.1761 11.68 86.1761 11.784 86.1761 11.88C86.1761 11.976 86.1681 12.04 86.1521 12.072H82.9601V11.88C82.9601 11.592 82.8721 11.352 82.6961 11.16C82.5201 10.952 82.2641 10.792 81.9281 10.68C81.6081 10.568 81.2161 10.512 80.7521 10.512C80.4321 10.512 80.1361 10.536 79.8641 10.584C79.6081 10.632 79.3841 10.704 79.1921 10.8C79.0001 10.896 78.8481 11.016 78.7361 11.16C78.6401 11.288 78.5921 11.448 78.5921 11.64C78.5921 11.912 78.7041 12.136 78.9281 12.312C79.1681 12.472 79.4801 12.608 79.8641 12.72C80.2481 12.832 80.6721 12.952 81.1361 13.08C81.7121 13.24 82.3121 13.4 82.9361 13.56C83.5761 13.704 84.1681 13.904 84.7121 14.16C85.2561 14.416 85.6961 14.784 86.0321 15.264C86.3681 15.728 86.5361 16.36 86.5361 17.16C86.5361 17.928 86.3841 18.576 86.0801 19.104C85.7921 19.632 85.3841 20.056 84.8561 20.376C84.3281 20.696 83.7121 20.928 83.0081 21.072C82.3041 21.216 81.5441 21.288 80.7281 21.288ZM87.56 21L93.896 4.536H98.312L104.648 21H100.784L99.608 17.76H92.432L91.256 21H87.56ZM93.464 14.88H98.576L97.112 10.824C97.048 10.648 96.968 10.44 96.872 10.2C96.792 9.944 96.704 9.664 96.608 9.36C96.512 9.056 96.416 8.76 96.32 8.472C96.24 8.168 96.16 7.896 96.08 7.656H95.936C95.856 7.96 95.752 8.32 95.624 8.736C95.496 9.136 95.368 9.528 95.24 9.912C95.112 10.28 95.008 10.584 94.928 10.824L93.464 14.88ZM113.375 21.288C112.559 21.288 111.807 21.128 111.119 20.808C110.447 20.472 109.903 19.968 109.487 19.296H109.319L109.055 21H106.319V3.648H109.655V9.768H109.799C110.055 9.4 110.367 9.088 110.735 8.832C111.103 8.576 111.519 8.392 111.983 8.28C112.447 8.152 112.951 8.088 113.495 8.088C114.487 8.088 115.351 8.32 116.087 8.784C116.839 9.248 117.423 9.968 117.839 10.944C118.255 11.904 118.463 13.144 118.463 14.664C118.463 16.184 118.255 17.432 117.839 18.408C117.439 19.384 116.855 20.112 116.087 20.592C115.335 21.056 114.431 21.288 113.375 21.288ZM112.343 18.552C113.015 18.552 113.543 18.424 113.927 18.168C114.327 17.896 114.615 17.496 114.791 16.968C114.967 16.44 115.055 15.776 115.055 14.976V14.424C115.055 13.624 114.967 12.96 114.791 12.432C114.615 11.888 114.327 11.488 113.927 11.232C113.543 10.96 113.015 10.824 112.343 10.824C111.863 10.824 111.455 10.912 111.119 11.088C110.783 11.248 110.503 11.488 110.279 11.808C110.071 12.112 109.911 12.496 109.799 12.96C109.687 13.424 109.631 13.936 109.631 14.496V14.928C109.631 15.68 109.727 16.328 109.919 16.872C110.111 17.416 110.407 17.832 110.807 18.12C111.207 18.408 111.719 18.552 112.343 18.552ZM120.921 21V3.648H124.257V21H120.921ZM133.055 21.288C131.663 21.288 130.495 21.056 129.551 20.592C128.607 20.112 127.895 19.384 127.415 18.408C126.935 17.432 126.695 16.192 126.695 14.688C126.695 13.168 126.935 11.928 127.415 10.968C127.895 9.992 128.599 9.272 129.527 8.808C130.471 8.328 131.623 8.088 132.983 8.088C134.263 8.088 135.343 8.32 136.223 8.784C137.103 9.232 137.767 9.936 138.215 10.896C138.663 11.84 138.887 13.064 138.887 14.568V15.432H130.079C130.111 16.168 130.223 16.792 130.415 17.304C130.623 17.816 130.935 18.2 131.351 18.456C131.783 18.696 132.351 18.816 133.055 18.816C133.439 18.816 133.783 18.768 134.087 18.672C134.407 18.576 134.679 18.432 134.903 18.24C135.127 18.048 135.303 17.808 135.431 17.52C135.559 17.232 135.623 16.904 135.623 16.536H138.887C138.887 17.336 138.743 18.032 138.455 18.624C138.167 19.216 137.767 19.712 137.255 20.112C136.743 20.496 136.127 20.792 135.407 21C134.703 21.192 133.919 21.288 133.055 21.288ZM130.127 13.32H135.455C135.455 12.84 135.391 12.424 135.263 12.072C135.151 11.72 134.991 11.432 134.783 11.208C134.575 10.984 134.319 10.824 134.015 10.728C133.727 10.616 133.399 10.56 133.031 10.56C132.423 10.56 131.911 10.664 131.495 10.872C131.095 11.064 130.783 11.368 130.559 11.784C130.351 12.184 130.207 12.696 130.127 13.32Z"
                    fill="currentColor"
                  />
                </svg>
              </a>
            </div>
            <div class="nav-collapse grow hidden w-full lg:flex lg:w-full flex-auto justify-center"
              id="main-navbar-collapse">
              <div class="justify-center flex flex-col lg:flex-row p-0 lg:bg-neutral-200 lg:rounded-full">
                <a class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold"
                  href="../index.html">
                  Home
                </a>
                <div class="btn-group group">
                  <button
                    class="inline-flex text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] py-3 text-[14px] font-medium transition-all leading-[1.429] dropdown-toggle arrow-none ltr:text-left rtl:text-right max-lg:w-full justify-between items-center"
                    type="button" data-pc-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Landings
                    <i class="ti ti-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-center group-[.drp-show]:max-lg:!relative !w-[936px] max-lg:!w-full max-lg:!transform-none !p-0 overflow-hidden shadow-[0px_0px_2px_0px_rgba(0,0,0,0.2),_rgba(26,28,30,0.06)_0px_16px_10px_0px]">
                    <div class="p-2">
                      <div class="grid grid-cols-12 gap-2">
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="../crm/crm.html" target="_blank" class="group/landinglinks block">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/crm-light.svg" class="block dark:hidden w-full" alt="images">
                                <img src="../assets/images/mega-menu/crm-dark.svg" class="hidden dark:block w-full" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">CRM</h6>
                                  <i class="ti ti-arrow-up-right text-base leading-none"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="../ai/ai.html" target="_blank" class="group/landinglinks block">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/ai-light.svg" class="block dark:hidden w-full" alt="images">
                                <img src="../assets/images/mega-menu/ai-dark.svg" class="hidden dark:block w-full" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">AI</h6>
                                  <i class="ti ti-arrow-up-right text-base leading-none"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="../crypto/crypto.html" target="_blank" class="group/landinglinks block">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/crypto-light.svg" class="block dark:hidden w-full" alt="images">
                                <img src="../assets/images/mega-menu/crypto-dark.svg" class="hidden dark:block w-full" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">Crypto</h6>
                                  <i class="ti ti-arrow-up-right text-base leading-none"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="../hosting/hosting.html" target="_blank" class="group/landinglinks block">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/hosting-light.svg" class="block dark:hidden w-full" alt="images">
                                <img src="../assets/images/mega-menu/hosting-dark.svg" class="hidden dark:block w-full" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">Hosting</h6>
                                  <i class="ti ti-arrow-up-right text-base leading-none"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="../pms/pms.html" target="_blank" class="group/landinglinks block">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/pms-light.svg" class="block dark:hidden w-full" alt="images">
                                <img src="../assets/images/mega-menu/pms-dark.svg" class="hidden dark:block w-full" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">PMS</h6>
                                  <i class="ti ti-arrow-up-right text-base leading-none"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="../hrm/hrm.html" target="_blank" class="group/landinglinks block">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/hrm-light.svg" class="block dark:hidden w-full" alt="images">
                                <img src="../assets/images/mega-menu/hrm-dark.svg" class="hidden dark:block w-full" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">HRM</h6>
                                  <i class="ti ti-arrow-up-right text-base leading-none"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="../plugin/plugin.html" target="_blank" class="group/landinglinks block">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/plugin-light.svg" class="block dark:hidden w-full" alt="images">
                                <img src="../assets/images/mega-menu/plugin-dark.svg" class="hidden dark:block w-full" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">Plugin</h6>
                                  <i class="ti ti-arrow-up-right text-base leading-none"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-span-6 sm:col-span-4 lg:col-span-3">
                          <a href="#" class="group/landinglinks block cursor-default">
                            <div class="p-2 rounded-xl overflow-hidden group-hover/landinglinks:bg-neutral-50 transition-all duration-300">
                              <div class="flex flex-col gap-2">
                                <img src="../assets/images/mega-menu/lms-light.svg" class="block dark:hidden w-full grayscale blur-[2px]" alt="images">
                                <img src="../assets/images/mega-menu/lms-dark.svg" class="hidden dark:block w-full grayscale blur-[2px]" alt="images">
                                <div class="flex flex-row justify-between items-center">
                                  <h6 class="subtitle1 text-theme-text-primary mt-0.5">LMS</h6>
                                  <span class="px-2 py-1 text-primary-500 bg-primary-100 rounded-full caption">Coming Soon</span>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="p-5 bg-neutral-100">
                      <div class="flex flex-col sm:flex-row gap-3 justify-between items-start sm:items-center">
                        <div class="flex flex-col gap-2">
                          <div class="flex items-center gap-3">
                            <h5>Explore our range of landing demos tailored to suit your needs</h5>
                            <div class="bg-theme-bg-default py-1 px-2 rounded-full hidden sm:inline-flex">
                              <h6 class="caption flex flex-row items-center">
                                <img class="w-4 h-4" src="../assets/images/shared/celebration.svg" alt="celebration"> 
                                <span class="px-3 py-1">Featured</span>                        
                              </h6>
                            </div>
                          </div>
                          <p class="body2 block">SaasAble offers 200+ customizable blocks, empowering you to effortlessly design and build landing pages tailored to your product or service needs.</p>
                        </div>
                        <a href="#" class="btn btn-primary px-4 py-2.5 shrink-0" target="_blank">Buy Now</a>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="../block/block.html"
                  class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold">
                  Blocks
                </a>
                <div class="btn-group">
                  <button
                  class="inline-flex text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] py-3 text-[14px] font-medium transition-all leading-[1.429] dropdown-toggle arrow-none ltr:text-left rtl:text-right max-lg:w-full justify-between items-center"
                    type="button" data-pc-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pages
                    <i class="ti ti-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-center group-[.drp-show]:max-lg:!relative !w-[860px] max-lg:!w-full max-lg:!transform-none !p-0 overflow-hidden shadow-[0px_0px_2px_0px_rgba(0,0,0,0.2),_rgba(26,28,30,0.06)_0px_16px_10px_0px]">
                    <div class="grid grid-cols-12 gap-3">
                      <div class="col-span-12 sm:col-span-4 p-2">
                        <div class="p-5 bg-neutral-100 h-full rounded-lg">
                            <div class="flex flex-col items-start gap-6 h-full justify-center">
                              <div class="flex flex-col gap-2">
                                <div class="flex flex-col items-start gap-3">
                                  <div class="bg-theme-bg-default rounded-full hidden sm:inline-flex">
                                    <span class="caption flex flex-row items-center">
                                      <img class="w-4 h-4 ltr:ml-2.5 rtl:mr-2.5"
                                        src="../assets/images/shared/celebration.svg" alt="celebration">
                                      <span class="subtitle2 px-3 py-1">SaasAble UI Kit</span>
                                    </span>
                                  </div>
                                  <h4>Kickstart your project with pre-built essentials pages.</h4>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="col-span-12 sm:col-span-8">
                        <div class="grid grid-cols-12 gap-2">
                          <div class="col-span-12 sm:col-span-4">
                            <div class="flex flex-col p-2 h-full max-w-full lg:max-w-[860px]">
                              <div class="subtitle1 p-2 text-theme-text-primary">General</div>
                              <ul class="*:*:block *:*:px-2.5 *:*:py-1 *:*:my-0.5 *:*:rounded-lg *:*:hover:bg-neutral-50 focus:*:*:bg-neutral-200 *:*:transition-all *:*:duration-300">
                                <li>
                                  <a href="../pages/about.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">About</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../pages/career.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Career</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../pages/privacy-policy.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Privacy Policy</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../pages/contact.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Contact Us</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../pages/faq.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">FAQs</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../pages/pricing.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Pricing</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-span-12 sm:col-span-4">
                            <div class="flex flex-col p-2 h-full max-w-full lg:max-w-[860px]">
                              <div class="subtitle1 p-2 text-theme-text-primary">Maintenance</div>
                              <ul class="*:*:block *:*:px-2.5 *:*:py-1 *:*:my-0.5 *:*:rounded-lg *:*:hover:bg-neutral-50 focus:*:*:bg-neutral-200 *:*:transition-all *:*:duration-300">
                                <li>
                                  <a href="../coming-soon/coming-soon-1.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Coming Soon</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../error404/error404-1.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Error 404</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../error500/error500-1.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Error 500</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="../under-maintenance/under-maintenance-1.html" target="_blank">
                                    <div class="flex flex-row justify-between items-center">
                                      <div class="body1 my-1 truncate">Under Maintenance</div>
                                      <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                    </div>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-span-12 sm:col-span-4">
                            <div class="flex flex-col p-2 h-full max-w-full lg:max-w-[860px]">
                              <div class="subtitle1 p-2 text-theme-text-primary">External</div>
                                <ul class="*:*:block *:*:px-2.5 *:*:py-1 *:*:my-0.5 *:*:rounded-lg *:*:hover:bg-neutral-50 focus:*:*:bg-neutral-200 *:*:transition-all *:*:duration-300">
                                  <li>
                                    <a href="https://blog.saasable.io/" target="_blank">
                                      <div class="flex flex-row justify-between items-center">
                                        <div class="body1 my-1 truncate">Blog</div>
                                        <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="https://phoenixcoded.gitbook.io/saasable-tailwind" target="_blank">
                                      <div class="flex flex-row justify-between items-center">
                                        <div class="body1 my-1 truncate">Documentation</div>
                                        <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="https://phoenixcoded.authordesk.app/" target="_blank">
                                      <div class="flex flex-row justify-between items-center">
                                        <div class="body1 my-1 truncate">Support</div>
                                        <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="https://discord.com/invite/gmqz4BWYA8" target="_blank">
                                      <div class="flex flex-row justify-between items-center">
                                        <div class="body1 my-1 truncate">Discord</div>
                                        <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="https://themeforest.net/licenses/standard" target="_blank">
                                      <div class="flex flex-row justify-between items-center">
                                        <div class="body1 my-1 truncate">Terms & Conditions</div>
                                        <i class="ti ti-arrow-up-right text-neutral-800 text-base leading-none"></i>
                                      </div>
                                    </a>
                                  </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="https://phoenixcoded.gitbook.io/saasable-tailwind" target="_blank"
                  class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold">
                  Docs
                  <i class="ti ti-pin-invoke text-[16px]"></i>
                </a>
                <div class="py-5 px-6 bg-neutral-100 flex items-center justify-between sm:hidden">
                  <a href="#" type="button" class="flex items-center justify-center h-10 w-10 rounded-full btn-outline-primary p-[9px_24px]">
                    <i class="ti ti-brand-github text-lg leading-none"></i>
                  </a>
                  <a href="#" class="btn-primary btn">Buy Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-3">
            <div class="btn-group">
              <a href="#" type="button"
                class="flex items-center justify-center h-10 w-10 rounded-full btn-outline-primary dropdown-toggle arrow-none p-[9px_24px]"
                type="button" data-pc-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-settings text-lg leading-none"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end leading-none !mt-2">
                <div class="dropdown-item !bg-transparent">
                  <label class="flex items-center gap-3 flex-1" for="theme-setup-dark">
                    <div class="shrink-0">
                      <i class="ti ti-sun-moon !text-2xl !leading-none"></i>
                    </div>
                    <div class="grow text-base leading-none" for="theme-setup-dark">Dark</div>
                    <div class="shrink-0">
                      <div class="form-check form-switch custom-switch-v1 !inline-flex !m-0">
                        <input type="checkbox" class="form-check-input input-primary" id="theme-setup-dark">
                      </div>
                    </div>
                  </label>
                </div>
                <div class="dropdown-item !bg-transparent">
                  <label class="flex items-center gap-3 flex-1" for="theme-setup-rtl">
                    <div class="shrink-0">
                      <i class="ti ti-text-direction-ltr !text-2xl !leading-none"></i>
                    </div>
                    <div class="grow text-base leading-none">RTL</div>
                    <div class="shrink-0">
                      <div class="form-check form-switch custom-switch-v1 !inline-flex !m-0">
                        <input type="checkbox" class="form-check-input input-primary" id="theme-setup-rtl">
                      </div>
                    </div>
                  </label>
                </div>
              </div>
            </div>
            <a href="#" type="button" class="max-sm:hidden flex items-center justify-center h-10 w-10 rounded-full btn-outline-primary p-[9px_24px]">
              <i class="ti ti-brand-github text-lg leading-none"></i>
            </a>
            @if (Route::has('login'))
                <a
                    href="{{ route('login') }}"
                    class="btn btn-primary px-4 py-2.5 shrink-0"
                >
                    Login
                </a>
            @endif
          </div>
          <button data-pc-toggle="nav-collapse" type="button" data-pc-target="#main-navbar-collapse"
            class="inline-flex ltr:ml-2 rtl:mr-2 items-center p-2 w-10 h-10 justify-center text-sm text-neutral-900 rounded-full lg:hidden hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-200  dark:focus:ring-gray-600">
            <i class="ti ti-menu-2 text-2xl leading-none"></i>
          </button>
        </div>
      </div>
    </nav>
    <!-- [ Nav ] end -->

    <!-- [ hero ] start -->
    <section class=" relative overflow-hidden">
      <div class="absolute top-0 z-10 inset-x-0 block bg-neutral-100 h-[540px] sm:h-[738px] lg:h-[878px] overflow-hidden rounded-b-3xl sm:rounded-b-[32px] lg:rounded-b-[40px]">
        <div class="absolute inset-0 z-20  bg-[radial-gradient(47.33%_47.33%_at_50%_46.88%,_transparent_0%,_var(--neutral-200)_100%)]"></div>
        <div class=" relative z-10 h-full bg-[length:40px_40px] bg-[url('data:image/svg+xml;utf8,<svg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%2050%2060%22><text%20x=%220%22%20y=%2225%22%20fill=%22%23E6E8EE%22%20font-size=%2280px%22>.%3C/text%3E</svg>')] dark:bg-[url('data:image/svg+xml;utf8,<svg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%2050%2060%22><text%20x=%220%22%20y=%2225%22%20fill=%22%23272A2E%22%20font-size=%2280px%22>.%3C/text%3E</svg>')]">
        </div>
      </div>
      <div class="common-section relative z-20">
        <div class="container animation-ref">
          <div class="pb-5 sm:pb-11 lg:pb-12">
            <div class="flex flex-col items-center gap-3">
              <div class="animate-y delay-reset py-3 px-6 text-theme-textsecondary caption rounded-full border border-theme-divider">
                <p class="body1">✦&nbsp;&nbsp; HR Solutions Made Easy &nbsp;&nbsp;✦</p>
              </div>
              <h1 class="animate-y max-w-[800px] text-center">
                Simplify HR Tasks, Prioritize Your Workforce
              </h1>
              <div class="animate-y text-primary-500">
                <!-- [ wawe image ] -->
                <svg class="w-[92px] md:w-[122px] h-auto" viewBox="0 0 122 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    opacity="0.4"
                    d="M1.46484 6.83613L4.45387 3.7103C7.74598 0.267505 13.38 0.760513 16.0241 4.72277L16.5428 5.50001C19.2423 9.54539 25.1877 9.54539 27.8873 5.5V5.5C30.5869 1.45461 36.5322 1.45461 39.2318 5.5V5.5C41.9314 9.54539 47.8768 9.54539 50.5764 5.5V5.5C53.2759 1.45461 59.2213 1.45461 61.9209 5.5V5.5C64.6205 9.54539 70.5658 9.54539 73.2654 5.5V5.5C75.965 1.45461 81.9104 1.45461 84.61 5.5V5.5C87.3096 9.54539 93.2549 9.54539 95.9545 5.5V5.5C98.6541 1.45461 104.599 1.45461 107.299 5.5V5.5C109.999 9.54539 115.944 9.54539 118.644 5.5L120.534 2.66667"
                    stroke="currentColor"
                    strokeLinecap="round"
                  />
                </svg>
              </div>
              <h6 class="animate-y max-w-[650px] text-center text-theme-text-secondary">Empower your HR team with our comprehensive platform for seamless HR management</h6>
            </div>
            <div class="flex flex-col items-center gap-4 mt-6 sm:mt-8 lg:mt-10">
              <div class="animate-y">
                <button class="btn btn-primary btn-md capitalize">
                  <span class="flex items-center gap-2 ltr:-ml-1 rtl:-mr-1">
                    <i class="ti ti-sparkles text-base leading-none"></i>
                    Try Predictive Cost Analytics
                  </span>
                </button>
              </div>
              <div class="animate-y flex flex-row gap-2 justify-center sm:gap-6 flex-wrap">
                <div class="flex flex-row items-center gap-2 text-theme-text-secondary">
                  <i class="ti ti-settings-up text-2xl leading-none"></i>
                  <p class="body2">Automated Scaling for Efficiency</p>
                </div>
                <div class="flex flex-row items-center gap-2 text-theme-text-secondary">
                  <i class="ti ti-chart-histogram text-2xl leading-none"></i>
                  <p class="body2">Real-time Performance Insights</p>
                </div>
              </div>
            </div>
          </div>
          <div class=" sticky top-0">
            <div class="img-hero-1">
              <img src="../assets/images/graphics/hrm/desktop1-light.svg" alt="image" class="block dark:hidden w-full border-[5px] border-neutral-300 rounded-2xl">
              <img src="../assets/images/graphics/hrm/desktop1-dark.svg" alt="image" class="hidden dark:block w-full border-[5px] border-neutral-300 rounded-2xl">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ hero ] end -->

    <link rel="stylesheet" href="../assets/css/plugins/tiny-slider.css" />
    <!-- [ Clientele ] start -->
    <section class="common-section overflow-hidden">
      <div class="container">
        <div class="flex flex-col items-center justify-center gap-5">
          <h6 class="animate-y delay-reset subtitle2 text-theme-textsecondary">4,000+ companies already growing</h6>
          <div class="animate-y relative overflow-hidden w-full" dir="ltr">
            <span class="absolute h-full w-10 sm:w-[60px] top-0 left-0 z-10 bg-[linear-gradient(90deg,_var(--theme-bg-default)_-8.54%,_transparent_100%)]"></span>
            <div class="clientele-slider3">
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 80 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M37.9217 20.2939V4.01182H41.6666L46.7373 14.1533L51.7383 4.01182H55.4831V20.2939H52.343V9.3384L47.9468 17.9679H45.458L41.0618 9.31514V20.2939H37.9217ZM64.9424 20.5731C63.7484 20.5731 62.6629 20.3327 61.686 19.852C60.7091 19.3713 59.9337 18.6502 59.36 17.6888C58.7862 16.7274 58.4993 15.5023 58.4993 14.0137V4.01182H61.6395V14.037C61.6395 14.8433 61.7713 15.5256 62.0349 16.0839C62.2985 16.6266 62.6862 17.0298 63.1979 17.2934C63.7096 17.557 64.3066 17.6888 64.9889 17.6888C65.7022 17.6888 66.307 17.557 66.8032 17.2934C67.3149 17.0298 67.7026 16.6266 67.9662 16.0839C68.2453 15.5256 68.3849 14.8433 68.3849 14.037V4.01182H71.525V14.0137C71.525 15.5023 71.2226 16.7274 70.6179 17.6888C70.0286 18.6502 69.2378 19.3713 68.2453 19.852C67.2529 20.3327 66.1519 20.5731 64.9424 20.5731ZM74.5156 20.2939V4.01182H77.6557V20.2939H74.5156Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M9.15706 7.14137L1.18999 2.51105C1.01476 2.41004 0.789629 2.46967 0.687409 2.64491C0.654553 2.7021 0.637516 2.76781 0.638733 2.83353V15.7181C0.638733 15.8507 0.711747 15.9676 0.822486 16.0345L3.79903 17.7844C3.97427 17.8854 4.19939 17.8258 4.30161 17.6493C4.33325 17.5946 4.35029 17.5313 4.35029 17.468V9.0592C4.35151 8.97767 4.41844 8.91318 4.49997 8.91439C4.52552 8.91439 4.54986 8.92169 4.57055 8.93386L9.16436 11.5648C9.6207 11.8252 10.1805 11.8228 10.6344 11.5575L15.1175 8.93386C15.188 8.89371 15.2781 8.91683 15.3182 8.98741C15.3304 9.00931 15.3377 9.03365 15.3377 9.05799V13.1736C15.3377 13.4291 15.2026 13.6652 14.9848 13.7978L10.3691 16.6344C10.2584 16.7014 10.1914 16.8218 10.1926 16.9508V21.0968C10.1926 21.2295 10.2584 21.3463 10.3618 21.4132L16.411 25.2355C16.882 25.5324 17.4782 25.5373 17.9541 25.2501L25.6425 20.6928C26.0915 20.4263 26.3653 19.9432 26.3629 19.4211V11.476C26.3629 11.2728 26.201 11.1073 25.9978 11.106C25.9296 11.106 25.8627 11.1243 25.8043 11.1596L23.3717 12.6296C22.9324 12.8937 22.6623 13.367 22.6586 13.8794V17.8708C22.6586 18.001 22.588 18.1215 22.4749 18.1872L17.9249 20.8705C17.4612 21.1418 16.8868 21.1394 16.4256 20.8632L13.9784 19.3932C13.8056 19.2873 13.7509 19.0609 13.8567 18.8881C13.8835 18.8431 13.92 18.8054 13.9638 18.7762L18.3885 15.858C18.801 15.5867 19.0505 15.1255 19.0505 14.6302V2.83353C19.0493 2.6303 18.8838 2.46724 18.6805 2.46845C18.6173 2.46845 18.554 2.48549 18.4992 2.51713L10.6344 7.14015C10.178 7.40543 9.6134 7.40543 9.15706 7.14015V7.14137Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M26.2688 3.18067V5.6948C26.2688 6.20225 26.0084 6.67562 25.5776 6.94456L23.1523 8.45108C22.9795 8.55695 22.7532 8.50219 22.6473 8.32818C22.612 8.26977 22.5938 8.20283 22.5938 8.13469V5.50374C22.5938 4.97926 22.8749 4.49493 23.3288 4.23208L25.7175 2.8655C25.8928 2.76449 26.1179 2.82412 26.2201 3.00057C26.2518 3.05533 26.2688 3.11861 26.2688 3.18189V3.18067Z"
                        class="fill-primary-500"
                      />
                    </svg>

                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 132 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M34.5584 20.3779V4.09581H40.2107C42.1025 4.09581 43.6609 4.43696 44.8859 5.11926C46.1265 5.78605 47.0414 6.73196 47.6306 7.957C48.2354 9.16653 48.5378 10.5931 48.5378 12.2369C48.5378 13.8806 48.2354 15.315 47.6306 16.54C47.0414 17.7495 46.1265 18.6954 44.8859 19.3777C43.6609 20.0445 42.1025 20.3779 40.2107 20.3779H34.5584ZM37.6986 17.6797H40.0246C41.3737 17.6797 42.4281 17.4627 43.188 17.0285C43.9633 16.5943 44.5138 15.974 44.8394 15.1677C45.1651 14.3458 45.3279 13.3689 45.3279 12.2369C45.3279 11.0894 45.1651 10.1124 44.8394 9.30609C44.5138 8.48423 43.9633 7.8562 43.188 7.42201C42.4281 6.98782 41.3737 6.77073 40.0246 6.77073H37.6986V17.6797ZM51.0939 20.3779V8.81762H53.8851L54.1875 10.9808C54.4666 10.4846 54.8077 10.0582 55.2109 9.70151C55.6296 9.32935 56.1026 9.04247 56.6298 8.84088C57.1725 8.6393 57.7695 8.5385 58.4208 8.5385V11.8647H57.5369C57.0562 11.8647 56.6065 11.919 56.1879 12.0275C55.7847 12.1361 55.4358 12.3144 55.1411 12.5625C54.8465 12.8106 54.6217 13.1518 54.4666 13.586C54.3115 14.0046 54.234 14.5396 54.234 15.1909V20.3779H51.0939ZM60.5455 20.3779V8.81762H63.6856V20.3779H60.5455ZM62.1039 7.16615C61.5457 7.16615 61.0805 6.99558 60.7083 6.65443C60.3517 6.31328 60.1733 5.89459 60.1733 5.39838C60.1733 4.87115 60.3517 4.44471 60.7083 4.11907C61.0805 3.79342 61.5457 3.6306 62.1039 3.6306C62.6777 3.6306 63.1429 3.79342 63.4995 4.11907C63.8717 4.44471 64.0578 4.87115 64.0578 5.39838C64.0578 5.89459 63.8717 6.31328 63.4995 6.65443C63.1429 6.99558 62.6777 7.16615 62.1039 7.16615ZM73.7215 20.6571C73.1477 20.6571 72.6205 20.5873 72.1398 20.4477C71.6746 20.3081 71.2559 20.1066 70.8837 19.8429C70.5116 19.5638 70.1937 19.2382 69.9301 18.866L69.5812 20.3779H66.7899V3.6306H69.9301V10.4458C70.2867 9.93411 70.7674 9.49217 71.3722 9.12C71.977 8.73234 72.7601 8.5385 73.7215 8.5385C74.807 8.5385 75.7684 8.80212 76.6057 9.32935C77.4586 9.85658 78.1332 10.5776 78.6294 11.4925C79.1256 12.4074 79.3737 13.4542 79.3737 14.6327C79.3737 15.7802 79.1256 16.8114 78.6294 17.7263C78.1332 18.6412 77.4586 19.3622 76.6057 19.8895C75.7684 20.4012 74.807 20.6571 73.7215 20.6571ZM73.0237 17.9124C73.6439 17.9124 74.1867 17.7728 74.6519 17.4937C75.1326 17.2145 75.5048 16.8269 75.7684 16.3307C76.0475 15.8344 76.1871 15.2607 76.1871 14.6094C76.1871 13.9736 76.0475 13.4076 75.7684 12.9114C75.5048 12.3997 75.1326 12.0043 74.6519 11.7251C74.1867 11.4305 73.6439 11.2832 73.0237 11.2832C72.4034 11.2832 71.8529 11.4305 71.3722 11.7251C70.8915 12.0043 70.5116 12.3919 70.2325 12.8882C69.9688 13.3844 69.837 13.9581 69.837 14.6094C69.837 15.2452 69.9688 15.8189 70.2325 16.3307C70.5116 16.8269 70.8915 17.2145 71.3722 17.4937C71.8529 17.7728 72.4034 17.9124 73.0237 17.9124ZM88.9633 20.6571C88.3895 20.6571 87.8623 20.5873 87.3816 20.4477C86.9164 20.3081 86.4977 20.1066 86.1255 19.8429C85.7533 19.5638 85.4355 19.2382 85.1718 18.866L84.8229 20.3779H82.0317V3.6306H85.1718V10.4458C85.5285 9.93411 86.0092 9.49217 86.614 9.12C87.2187 8.73234 88.0018 8.5385 88.9633 8.5385C90.0487 8.5385 91.0101 8.80212 91.8475 9.32935C92.7004 9.85658 93.3749 10.5776 93.8711 11.4925C94.3674 12.4074 94.6155 13.4542 94.6155 14.6327C94.6155 15.7802 94.3674 16.8114 93.8711 17.7263C93.3749 18.6412 92.7004 19.3622 91.8475 19.8895C91.0101 20.4012 90.0487 20.6571 88.9633 20.6571ZM88.2654 17.9124C88.8857 17.9124 89.4285 17.7728 89.8937 17.4937C90.3744 17.2145 90.7465 16.8269 91.0101 16.3307C91.2893 15.8344 91.4288 15.2607 91.4288 14.6094C91.4288 13.9736 91.2893 13.4076 91.0101 12.9114C90.7465 12.3997 90.3744 12.0043 89.8937 11.7251C89.4285 11.4305 88.8857 11.2832 88.2654 11.2832C87.6452 11.2832 87.0947 11.4305 86.614 11.7251C86.1333 12.0043 85.7533 12.3919 85.4742 12.8882C85.2106 13.3844 85.0788 13.9581 85.0788 14.6094C85.0788 15.2452 85.2106 15.8189 85.4742 16.3307C85.7533 16.8269 86.1333 17.2145 86.614 17.4937C87.0947 17.7728 87.6452 17.9124 88.2654 17.9124ZM104.205 20.6571C103.631 20.6571 103.104 20.5873 102.623 20.4477C102.158 20.3081 101.739 20.1066 101.367 19.8429C100.995 19.5638 100.677 19.2382 100.414 18.866L100.065 20.3779H97.2735V3.6306H100.414V10.4458C100.77 9.93411 101.251 9.49217 101.856 9.12C102.461 8.73234 103.244 8.5385 104.205 8.5385C105.29 8.5385 106.252 8.80212 107.089 9.32935C107.942 9.85658 108.617 10.5776 109.113 11.4925C109.609 12.4074 109.857 13.4542 109.857 14.6327C109.857 15.7802 109.609 16.8114 109.113 17.7263C108.617 18.6412 107.942 19.3622 107.089 19.8895C106.252 20.4012 105.29 20.6571 104.205 20.6571ZM103.507 17.9124C104.127 17.9124 104.67 17.7728 105.135 17.4937C105.616 17.2145 105.988 16.8269 106.252 16.3307C106.531 15.8344 106.671 15.2607 106.671 14.6094C106.671 13.9736 106.531 13.4076 106.252 12.9114C105.988 12.3997 105.616 12.0043 105.135 11.7251C104.67 11.4305 104.127 11.2832 103.507 11.2832C102.887 11.2832 102.336 11.4305 101.856 11.7251C101.375 12.0043 100.995 12.3919 100.716 12.8882C100.452 13.3844 100.321 13.9581 100.321 14.6094C100.321 15.2452 100.452 15.8189 100.716 16.3307C100.995 16.8269 101.375 17.2145 101.856 17.4937C102.336 17.7728 102.887 17.9124 103.507 17.9124ZM112.515 20.3779V3.6306H115.655V20.3779H112.515ZM124.323 20.6571C123.145 20.6571 122.098 20.4089 121.183 19.9127C120.284 19.4165 119.578 18.7187 119.066 17.8193C118.555 16.9199 118.299 15.881 118.299 14.7024C118.299 13.5084 118.547 12.4462 119.043 11.5158C119.555 10.5854 120.26 9.85658 121.16 9.32935C122.075 8.80212 123.137 8.5385 124.347 8.5385C125.494 8.5385 126.502 8.79436 127.37 9.30609C128.254 9.8023 128.937 10.4768 129.417 11.3297C129.913 12.1826 130.162 13.1595 130.162 14.2605C130.162 14.4156 130.162 14.5861 130.162 14.7722C130.162 14.9583 130.146 15.1599 130.115 15.377H120.555V13.4464H126.975C126.928 12.7331 126.657 12.1671 126.161 11.7484C125.68 11.3142 125.075 11.0971 124.347 11.0971C123.804 11.0971 123.308 11.2212 122.858 11.4693C122.408 11.7019 122.052 12.0585 121.788 12.5393C121.524 13.02 121.392 13.6247 121.392 14.3535V15.0281C121.392 15.6484 121.517 16.1911 121.765 16.6563C122.013 17.106 122.354 17.4627 122.788 17.7263C123.238 17.9744 123.742 18.0984 124.3 18.0984C124.874 18.0984 125.354 17.9744 125.742 17.7263C126.13 17.4627 126.424 17.1293 126.626 16.7261H129.836C129.603 17.4549 129.231 18.1217 128.719 18.7265C128.208 19.3157 127.58 19.7887 126.835 20.1453C126.091 20.4865 125.254 20.6571 124.323 20.6571Z"
                        class="fill-primary-500"
                      />
                      <g clipPath="url(#clip0_10969_1027)">
                        <path
                          d="M0 12.1836C0 10.0983 0.513682 8.17393 1.541 6.41059C2.56834 4.64725 3.96368 3.25193 5.727 2.22459C7.49034 1.19725 9.41468 0.683594 11.5 0.683594C13.5853 0.683594 15.5097 1.19725 17.273 2.22459C19.0363 3.25193 20.4317 4.64725 21.459 6.41059C22.4863 8.17393 23 10.0983 23 12.1836C23 14.2689 22.4863 16.1933 21.459 17.9566C20.4317 19.7199 19.0363 21.1153 17.273 22.1426C15.5097 23.1699 13.5853 23.6836 11.5 23.6836C9.41468 23.6836 7.49034 23.1699 5.727 22.1426C3.96368 21.1153 2.56834 19.7199 1.541 17.9566C0.513682 16.1933 0 14.2689 0 12.1836ZM1.909 12.1836C1.909 14.5756 2.714 16.6839 4.324 18.5086C5.06 17.0673 6.22534 15.6949 7.82 14.3916C9.41468 13.0883 10.971 12.2679 12.489 11.9306C12.259 11.3939 12.0367 10.9109 11.822 10.4816C9.18468 11.3249 6.33268 11.7466 3.266 11.7466C2.668 11.7466 2.22334 11.7389 1.932 11.7236C1.932 11.7849 1.92818 11.8616 1.9205 11.9536C1.91284 12.0456 1.909 12.1223 1.909 12.1836ZM2.208 9.81459C2.54534 9.84525 3.04368 9.86059 3.703 9.86059C6.26368 9.86059 8.694 9.51559 10.994 8.82559C9.82868 6.75559 8.54834 5.03059 7.153 3.65059C5.94168 4.26393 4.90284 5.11493 4.0365 6.20359C3.17018 7.29225 2.56068 8.49593 2.208 9.81459ZM5.635 19.7506C7.36768 21.0999 9.32268 21.7746 11.5 21.7746C12.6347 21.7746 13.7617 21.5599 14.881 21.1306C14.5743 18.5086 13.9763 15.9709 13.087 13.5176C11.6763 13.8243 10.2542 14.5986 8.8205 15.8406C7.38684 17.0826 6.325 18.3859 5.635 19.7506ZM9.154 2.91459C10.5033 4.30993 11.753 6.05025 12.903 8.13559C14.9883 7.26159 16.56 6.14993 17.618 4.80059C15.8393 3.32859 13.8 2.59259 11.5 2.59259C10.718 2.59259 9.936 2.69993 9.154 2.91459ZM13.731 9.76859C13.961 10.2593 14.2217 10.8803 14.513 11.6316C15.6477 11.5243 16.882 11.4706 18.216 11.4706C19.1667 11.4706 20.1097 11.4936 21.045 11.5396C20.9223 9.45425 20.171 7.59893 18.791 5.97359C17.7943 7.46093 16.1077 8.72593 13.731 9.76859ZM15.088 13.2416C15.87 15.5109 16.399 17.8416 16.675 20.2336C17.8863 19.4516 18.8753 18.4473 19.642 17.2206C20.4087 15.9939 20.8687 14.6676 21.022 13.2416C19.9027 13.1649 18.883 13.1266 17.963 13.1266C17.1197 13.1266 16.1613 13.1649 15.088 13.2416Z"
                          class="fill-primary-500"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_10969_1027">
                          <rect width="23" height="23" class="fill-secondary-100" transform="translate(0 0.683594)" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 106 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M41.3152 20.7791C40.2298 20.7791 39.2606 20.5155 38.4077 19.9883C37.5548 19.461 36.8803 18.74 36.3841 17.8251C35.8879 16.8947 35.6397 15.8557 35.6397 14.7082C35.6397 13.5452 35.8879 12.514 36.3841 11.6146C36.8803 10.6997 37.5548 9.97865 38.4077 9.45142C39.2761 8.92419 40.2453 8.66057 41.3152 8.66057C42.1681 8.66057 42.9124 8.82339 43.5482 9.14903C44.1995 9.45917 44.719 9.90111 45.1066 10.4749V3.75267H48.2468V20.5H45.4555L45.1066 18.895C44.8585 19.2362 44.5639 19.5541 44.2228 19.8487C43.8816 20.1278 43.4707 20.3527 42.99 20.5233C42.5093 20.6938 41.951 20.7791 41.3152 20.7791ZM42.013 18.0344C42.6333 18.0344 43.1838 17.8949 43.6645 17.6157C44.1452 17.3211 44.5174 16.9257 44.781 16.4295C45.0446 15.9333 45.1764 15.3673 45.1764 14.7315C45.1764 14.0802 45.0446 13.5064 44.781 13.0102C44.5174 12.4985 44.1452 12.1031 43.6645 11.824C43.1838 11.5448 42.6333 11.4053 42.013 11.4053C41.4083 11.4053 40.8655 11.5526 40.3848 11.8472C39.9041 12.1263 39.5242 12.514 39.2451 13.0102C38.9815 13.5064 38.8497 14.0724 38.8497 14.7082C38.8497 15.3595 38.9815 15.9333 39.2451 16.4295C39.5087 16.9257 39.8809 17.3211 40.3616 17.6157C40.8578 17.8949 41.4083 18.0344 42.013 18.0344ZM56.9286 20.7791C55.7501 20.7791 54.7034 20.531 53.7885 20.0348C52.8891 19.5386 52.1835 18.8408 51.6718 17.9414C51.1601 17.042 50.9042 16.003 50.9042 14.8245C50.9042 13.6305 51.1523 12.5683 51.6486 11.6379C52.1603 10.7075 52.8658 9.97865 53.7652 9.45142C54.6801 8.92419 55.7424 8.66057 56.9519 8.66057C58.0994 8.66057 59.1073 8.91643 59.9757 9.42816C60.8596 9.92437 61.5419 10.5989 62.0226 11.4518C62.5188 12.3047 62.7669 13.2816 62.7669 14.3826C62.7669 14.5376 62.7669 14.7082 62.7669 14.8943C62.7669 15.0804 62.7514 15.282 62.7204 15.4991H53.1605V13.5685H59.5803C59.5338 12.8552 59.2624 12.2892 58.7662 11.8705C58.2855 11.4363 57.6807 11.2192 56.9519 11.2192C56.4091 11.2192 55.9129 11.3432 55.4632 11.5914C55.0135 11.824 54.6569 12.1806 54.3933 12.6613C54.1296 13.142 53.9978 13.7468 53.9978 14.4756V15.1502C53.9978 15.7704 54.1219 16.3132 54.37 16.7784C54.6181 17.2281 54.9593 17.5847 55.3935 17.8483C55.8431 18.0964 56.3471 18.2205 56.9054 18.2205C57.4791 18.2205 57.9598 18.0964 58.3475 17.8483C58.7352 17.5847 59.0298 17.2513 59.2314 16.8482H62.4413C62.2087 17.577 61.8365 18.2438 61.3248 18.8485C60.8131 19.4378 60.185 19.9107 59.4407 20.2674C58.6964 20.6085 57.859 20.7791 56.9286 20.7791ZM67.9082 20.5L63.6748 8.93969H66.9777L69.8155 17.546L72.6765 8.93969H75.9329L71.6996 20.5H67.9082ZM78.2486 20.6163C77.6748 20.6163 77.2019 20.4457 76.8297 20.1046C76.473 19.7479 76.2947 19.3137 76.2947 18.802C76.2947 18.2903 76.473 17.8638 76.8297 17.5227C77.2019 17.166 77.6748 16.9877 78.2486 16.9877C78.8223 16.9877 79.2875 17.166 79.6442 17.5227C80.0008 17.8638 80.1792 18.2903 80.1792 18.802C80.1792 19.3137 80.0008 19.7479 79.6442 20.1046C79.2875 20.4457 78.8223 20.6163 78.2486 20.6163ZM87.8567 20.5C87.0348 20.5 86.3137 20.3759 85.6935 20.1278C85.0887 19.8642 84.6157 19.4378 84.2746 18.8485C83.9334 18.2438 83.7629 17.4219 83.7629 16.3829V11.5681H81.7858V8.93969H83.7629L84.1118 5.79957H86.903V8.93969H89.9733V11.5681H86.903V16.4295C86.903 16.9567 87.0193 17.3211 87.2519 17.5227C87.4845 17.7243 87.8799 17.8251 88.4382 17.8251H89.9036V20.5H87.8567ZM97.7902 20.7791C96.6892 20.7791 95.689 20.5233 94.7896 20.0115C93.9058 19.4998 93.2002 18.7865 92.673 17.8716C92.1457 16.9567 91.8821 15.91 91.8821 14.7315C91.8821 13.5375 92.1457 12.483 92.673 11.5681C93.2002 10.6532 93.9135 9.93988 94.8129 9.42816C95.7123 8.91643 96.7125 8.66057 97.8135 8.66057C98.9455 8.66057 99.9534 8.91643 100.837 9.42816C101.737 9.93988 102.442 10.6532 102.954 11.5681C103.481 12.483 103.745 13.5375 103.745 14.7315C103.745 15.91 103.481 16.9567 102.954 17.8716C102.442 18.7865 101.737 19.4998 100.837 20.0115C99.9379 20.5233 98.9222 20.7791 97.7902 20.7791ZM97.8135 18.0577C98.3097 18.0577 98.7594 17.9336 99.1626 17.6855C99.5812 17.4374 99.9146 17.0652 100.163 16.569C100.426 16.0728 100.558 15.4603 100.558 14.7315C100.558 13.9872 100.434 13.3669 100.186 12.8707C99.9379 12.3744 99.6045 12.0023 99.1858 11.7542C98.7826 11.5061 98.3329 11.382 97.8367 11.382C97.3405 11.382 96.8831 11.5061 96.4644 11.7542C96.0457 12.0023 95.7123 12.3744 95.4642 12.8707C95.2161 13.3669 95.092 13.9872 95.092 14.7315C95.092 15.4603 95.2161 16.0728 95.4642 16.569C95.7123 17.0652 96.0379 17.4374 96.4411 17.6855C96.8598 17.9336 97.3173 18.0577 97.8135 18.0577Z"
                        class="fill-primary-500"
                      />
                      <g clip-path="url(#clip0_10973_27015)">
                        <path
                          d="M7.47938 10.6561C7.28018 10.5072 7.08047 10.4327 6.88127 10.4327H5.98592V15.7962H6.88179C7.08098 15.7962 7.28069 15.7217 7.47989 15.5728C7.67908 15.424 7.77868 15.2006 7.77868 14.9023V11.3266C7.77817 11.0288 7.67806 10.805 7.47938 10.6561ZM22.0587 1.60547H3.56629C2.32388 1.60547 1.31558 2.61121 1.3125 3.85413V22.3568C1.31558 23.5997 2.32388 24.6055 3.56629 24.6055H22.0587C23.3016 24.6055 24.3094 23.5997 24.3125 22.3568V3.85413C24.3094 2.61121 23.3011 1.60547 22.0587 1.60547ZM9.22902 14.9121C9.22902 15.8778 8.63297 17.341 6.74625 17.3379H4.36411V8.84328H6.79656C8.61603 8.84328 9.22799 10.3044 9.2285 11.2706L9.22902 14.9121ZM14.3979 10.3604H11.6625V12.3328H13.3346V13.8509H11.6625V15.8229H14.3984V17.341H11.2061C10.6331 17.3558 10.1567 16.903 10.1423 16.3301V9.90703C10.1285 9.3346 10.5818 8.8592 11.1542 8.84482H14.3984L14.3979 10.3604ZM19.7187 16.2793C19.041 17.8579 17.8268 17.5438 17.2831 16.2793L15.305 8.84534H16.9771L18.5024 14.6836L20.0205 8.84534H21.6932L19.7187 16.2793Z"
                          class="fill-primary-500"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_10973_27015">
                          <rect width="24" height="24" class="fill-primary-500" transform="translate(0.5 1.5)" />
                        </clipPath>
                      </defs>
                    </svg>

                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 106 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M34.2891 20.7791C33.1106 20.7791 32.0639 20.531 31.149 20.0348C30.2496 19.5386 29.5441 18.8408 29.0323 17.9414C28.5206 17.042 28.2647 16.003 28.2647 14.8245C28.2647 13.6305 28.5129 12.5683 29.0091 11.6379C29.5208 10.7075 30.2264 9.97865 31.1258 9.45142C32.0407 8.92419 33.1029 8.66057 34.3124 8.66057C35.4599 8.66057 36.4678 8.91643 37.3362 9.42816C38.2201 9.92437 38.9024 10.5989 39.3831 11.4518C39.8793 12.3047 40.1274 13.2816 40.1274 14.3826C40.1274 14.5376 40.1274 14.7082 40.1274 14.8943C40.1274 15.0804 40.1119 15.282 40.0809 15.4991H30.521V13.5685H36.9408C36.8943 12.8552 36.6229 12.2892 36.1267 11.8705C35.646 11.4363 35.0412 11.2192 34.3124 11.2192C33.7697 11.2192 33.2734 11.3432 32.8237 11.5914C32.374 11.824 32.0174 12.1806 31.7538 12.6613C31.4902 13.142 31.3584 13.7468 31.3584 14.4756V15.1502C31.3584 15.7704 31.4824 16.3132 31.7305 16.7784C31.9786 17.2281 32.3198 17.5847 32.754 17.8483C33.2037 18.0964 33.7076 18.2205 34.2659 18.2205C34.8396 18.2205 35.3203 18.0964 35.708 17.8483C36.0957 17.5847 36.3903 17.2513 36.5919 16.8482H39.8018C39.5692 17.577 39.197 18.2438 38.6853 18.8485C38.1736 19.4378 37.5456 19.9107 36.8012 20.2674C36.0569 20.6085 35.2195 20.7791 34.2891 20.7791ZM42.6294 20.5V8.93969H45.3973L45.6299 10.8703C45.9866 10.219 46.4983 9.69177 47.1651 9.2886C47.8319 8.86991 48.6305 8.66057 49.5609 8.66057C50.5223 8.66057 51.3364 8.86991 52.0032 9.2886C52.67 9.69177 53.1817 10.2888 53.5384 11.0796C53.895 11.8705 54.0734 12.8474 54.0734 14.0104V20.5H50.9332V14.2895C50.9332 13.3436 50.7394 12.6148 50.3517 12.1031C49.9641 11.5758 49.3515 11.3122 48.5142 11.3122C47.987 11.3122 47.514 11.444 47.0953 11.7077C46.6766 11.9558 46.351 12.3202 46.1184 12.8009C45.8858 13.2661 45.7695 13.8398 45.7695 14.5221V20.5H42.6294ZM59.9198 20.5L55.6865 8.93969H58.9894L61.8272 17.546L64.6882 8.93969H67.9446L63.7113 20.5H59.9198ZM73.0926 20.7791C72.1156 20.7791 71.3015 20.6241 70.6502 20.3139C70.0145 20.0038 69.5415 19.5851 69.2314 19.0579C68.9212 18.5151 68.7662 17.9259 68.7662 17.2901C68.7662 16.5923 68.9445 15.972 69.3011 15.4293C69.6733 14.8865 70.2316 14.4679 70.9759 14.1732C71.7202 13.8631 72.6584 13.708 73.7904 13.708H76.6979C76.6979 13.1498 76.6126 12.6923 76.442 12.3357C76.287 11.9635 76.0388 11.6844 75.6977 11.4983C75.3721 11.3122 74.9534 11.2192 74.4416 11.2192C73.8369 11.2192 73.3174 11.351 72.8832 11.6146C72.4645 11.8782 72.2087 12.2814 72.1156 12.8241H69.0685C69.1461 11.9713 69.4252 11.2425 69.9059 10.6377C70.3866 10.0174 71.0224 9.5367 71.8132 9.19555C72.6041 8.8389 73.4802 8.66057 74.4416 8.66057C75.5426 8.66057 76.4963 8.84665 77.3026 9.21882C78.109 9.59098 78.7293 10.126 79.1635 10.8238C79.6132 11.5216 79.838 12.3744 79.838 13.3824V20.5H77.1863L76.8374 18.709C76.6824 19.0191 76.4808 19.2982 76.2327 19.5463C76.0001 19.7944 75.7287 20.0115 75.4186 20.1976C75.1084 20.3837 74.7595 20.5233 74.3719 20.6163C73.9842 20.7248 73.5578 20.7791 73.0926 20.7791ZM73.8369 18.3601C74.2556 18.3601 74.62 18.2903 74.9301 18.1507C75.2558 17.9957 75.5271 17.7941 75.7442 17.546C75.9768 17.2978 76.1551 17.011 76.2792 16.6853C76.4188 16.3442 76.5118 15.9953 76.5583 15.6386V15.6154H74.1393C73.6586 15.6154 73.2631 15.6774 72.953 15.8014C72.6584 15.9255 72.4413 16.0961 72.3017 16.3132C72.1621 16.5148 72.0924 16.7551 72.0924 17.0342C72.0924 17.3134 72.1621 17.5537 72.3017 17.7553C72.4413 17.9569 72.6429 18.112 72.9065 18.2205C73.1701 18.3135 73.4802 18.3601 73.8369 18.3601ZM87.7732 20.5C86.9513 20.5 86.2303 20.3759 85.61 20.1278C85.0052 19.8642 84.5323 19.4378 84.1911 18.8485C83.85 18.2438 83.6794 17.4219 83.6794 16.3829V11.5681H81.7023V8.93969H83.6794L84.0283 5.79957H86.8195V8.93969H89.8899V11.5681H86.8195V16.4295C86.8195 16.9567 86.9358 17.3211 87.1684 17.5227C87.401 17.7243 87.7964 17.8251 88.3547 17.8251H89.8201V20.5H87.7732ZM97.7067 20.7791C96.6057 20.7791 95.6056 20.5233 94.7062 20.0115C93.8223 19.4998 93.1167 18.7865 92.5895 17.8716C92.0623 16.9567 91.7986 15.91 91.7986 14.7315C91.7986 13.5375 92.0623 12.483 92.5895 11.5681C93.1167 10.6532 93.83 9.93988 94.7294 9.42816C95.6288 8.91643 96.629 8.66057 97.73 8.66057C98.862 8.66057 99.8699 8.91643 100.754 9.42816C101.653 9.93988 102.359 10.6532 102.87 11.5681C103.398 12.483 103.661 13.5375 103.661 14.7315C103.661 15.91 103.398 16.9567 102.87 17.8716C102.359 18.7865 101.653 19.4998 100.754 20.0115C99.8544 20.5233 98.8387 20.7791 97.7067 20.7791ZM97.73 18.0577C98.2262 18.0577 98.6759 17.9336 99.0791 17.6855C99.4978 17.4374 99.8312 17.0652 100.079 16.569C100.343 16.0728 100.475 15.4603 100.475 14.7315C100.475 13.9872 100.351 13.3669 100.103 12.8707C99.8544 12.3744 99.521 12.0023 99.1023 11.7542C98.6992 11.5061 98.2495 11.382 97.7532 11.382C97.257 11.382 96.7996 11.5061 96.3809 11.7542C95.9622 12.0023 95.6288 12.3744 95.3807 12.8707C95.1326 13.3669 95.0085 13.9872 95.0085 14.7315C95.0085 15.4603 95.1326 16.0728 95.3807 16.569C95.6288 17.0652 95.9545 17.4374 96.3576 17.6855C96.7763 17.9336 97.2338 18.0577 97.73 18.0577Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M10.0537 24C10.623 24 11.0821 23.541 11.0821 22.9717C11.0821 22.4024 10.623 21.9434 10.0537 21.9434C9.48447 21.9434 9.02539 22.4024 9.02539 22.9717C9.02539 23.541 9.48447 24 10.0537 24Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M15.9605 15.9692L10.17 16.5874C10.0659 16.5997 10.0109 16.465 10.0965 16.3977L15.7646 11.9844C16.1319 11.6845 16.3645 11.2131 16.2666 10.7112C16.1686 9.93996 15.532 9.43804 14.7302 9.54209L8.57241 10.4419C8.46223 10.4603 8.40714 10.3195 8.49284 10.2521L14.5955 5.5879C15.8014 4.65138 15.8993 2.80894 14.7975 1.73776C13.7937 0.733909 12.1899 0.764515 11.1861 1.76837L1.33733 11.7885C0.97007 12.1925 0.804802 12.725 0.902739 13.2943C1.06801 14.2002 1.97392 14.8001 2.87984 14.6348L8.18066 13.5514C8.29696 13.5269 8.35817 13.6799 8.26024 13.7473L2.37791 17.5117C1.64339 17.983 1.30673 18.8155 1.53933 19.6541C1.77193 20.7558 2.87984 21.3924 3.95102 21.1292L12.747 18.9624C12.8449 18.9379 12.9184 19.0542 12.8571 19.1338L11.486 20.8293C11.1188 21.3006 11.7186 21.9311 12.2206 21.5638L16.7379 17.8484C17.5397 17.1812 17.0072 15.8713 15.9666 15.9753L15.9605 15.9692Z"
                        class="fill-primary-500"
                      />
                    </svg>                

                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 110 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#:r4:)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M23.627 13.126C23.627 19.4773 18.4782 24.626 12.127 24.626C5.77568 24.626 0.626953 19.4773 0.626953 13.126C0.626953 6.7747 5.77568 1.62598 12.127 1.62598C18.4782 1.62598 23.627 6.7747 23.627 13.126ZM18.0549 11.508C18.9838 11.4765 19.7615 12.1997 19.7957 13.1259C19.8072 13.7719 19.4441 14.3666 18.8665 14.6554C18.878 14.824 18.878 14.9927 18.8665 15.1614C18.8665 17.7397 15.865 19.8322 12.1633 19.8322C8.46157 19.8322 5.46007 17.7369 5.46007 15.1614C5.44857 14.9927 5.44857 14.824 5.46007 14.6554C5.29141 14.581 5.14012 14.4752 5.00851 14.3523C4.33103 13.7177 4.2996 12.6544 4.93414 11.9797C5.56868 11.3022 6.63205 11.2708 7.30672 11.9053C8.63305 11.0078 10.1909 10.5161 11.7917 10.4903L12.6407 6.49984V6.49422C12.6836 6.29974 12.8753 6.17963 13.0667 6.22256L15.8852 6.7858C16.0651 6.47122 16.391 6.25962 16.7541 6.22256C17.3858 6.15382 17.9516 6.61126 18.0204 7.24299C18.0891 7.87473 17.6317 8.44078 16.9999 8.50927C16.3682 8.57802 15.8022 8.12057 15.7337 7.48884L13.2724 6.97134L12.5264 10.5588C14.1073 10.5931 15.6452 11.0819 16.9545 11.9738C17.2517 11.6909 17.6432 11.5223 18.0549 11.508ZM9.44776 13.1259C8.81322 13.1259 8.29572 13.6434 8.29572 14.2779C8.29572 14.9125 8.81041 15.4241 9.44776 15.43C10.0823 15.43 10.5998 14.9125 10.5998 14.2779C10.5998 13.6434 10.0823 13.1259 9.44776 13.1259ZM14.9762 17.4394V17.4851C15.1019 17.3622 15.1047 17.1565 14.9818 17.0308C14.8586 16.905 14.6529 16.9022 14.5272 17.0251C13.827 17.5253 12.9808 17.7711 12.1232 17.7254C11.2658 17.7655 10.4225 17.5081 9.73066 17.0021C9.61336 16.9078 9.45032 16.9078 9.33609 17.0021C9.20447 17.1108 9.18454 17.3078 9.29315 17.4394C10.1109 18.054 11.1112 18.3686 12.1347 18.3257C13.1582 18.3683 14.1587 18.054 14.9762 17.4394ZM14.7618 15.5128H14.819C15.4536 15.487 15.9481 14.9526 15.9225 14.3178C15.9225 13.6832 15.405 13.1657 14.7705 13.1657C14.1359 13.1657 13.6184 13.6832 13.6184 14.3178C13.6184 14.9523 14.1359 15.4698 14.7705 15.4698L14.7618 15.5128Z"
                          class="fill-primary-500"></path>
                      </g>
                      <path
                        d="M36.0584 20.5V4.21788H42.1526C43.4552 4.21788 44.5329 4.44273 45.3858 4.89242C46.2541 5.34212 46.8977 5.94688 47.3164 6.70672C47.735 7.45104 47.9444 8.28065 47.9444 9.19555C47.9444 10.0639 47.735 10.878 47.3164 11.6379C46.9132 12.3822 46.2774 12.987 45.409 13.4522C44.5561 13.9019 43.4552 14.1267 42.1061 14.1267H39.1986V20.5H36.0584ZM44.5019 20.5L41.1524 13.3359H44.5484L48.0839 20.5H44.5019ZM39.1986 11.8472H41.9665C42.9124 11.8472 43.6102 11.6146 44.0599 11.1494C44.5096 10.6842 44.7345 10.0717 44.7345 9.31186C44.7345 8.55202 44.5096 7.95501 44.0599 7.52082C43.6257 7.07113 42.9202 6.84628 41.9433 6.84628H39.1986V11.8472ZM55.5657 20.7791C54.3872 20.7791 53.3405 20.531 52.4256 20.0348C51.5262 19.5386 50.8206 18.8408 50.3089 17.9414C49.7972 17.042 49.5413 16.003 49.5413 14.8245C49.5413 13.6305 49.7894 12.5683 50.2857 11.6379C50.7974 10.7075 51.5029 9.97865 52.4023 9.45142C53.3172 8.92419 54.3795 8.66057 55.589 8.66057C56.7365 8.66057 57.7444 8.91643 58.6128 9.42816C59.4967 9.92437 60.179 10.5989 60.6597 11.4518C61.1559 12.3047 61.404 13.2816 61.404 14.3826C61.404 14.5376 61.404 14.7082 61.404 14.8943C61.404 15.0804 61.3885 15.282 61.3575 15.4991H51.7976V13.5685H58.2174C58.1709 12.8552 57.8995 12.2892 57.4033 11.8705C56.9226 11.4363 56.3178 11.2192 55.589 11.2192C55.0462 11.2192 54.55 11.3432 54.1003 11.5914C53.6506 11.824 53.294 12.1806 53.0304 12.6613C52.7667 13.142 52.6349 13.7468 52.6349 14.4756V15.1502C52.6349 15.7704 52.759 16.3132 53.0071 16.7784C53.2552 17.2281 53.5964 17.5847 54.0306 17.8483C54.4802 18.0964 54.9842 18.2205 55.5425 18.2205C56.1162 18.2205 56.5969 18.0964 56.9846 17.8483C57.3723 17.5847 57.6669 17.2513 57.8685 16.8482H61.0784C60.8458 17.577 60.4736 18.2438 59.9619 18.8485C59.4502 19.4378 58.8221 19.9107 58.0778 20.2674C57.3335 20.6085 56.4961 20.7791 55.5657 20.7791ZM69.2093 20.7791C68.1238 20.7791 67.1546 20.5155 66.3017 19.9883C65.4489 19.461 64.7743 18.74 64.2781 17.8251C63.7819 16.8947 63.5338 15.8557 63.5338 14.7082C63.5338 13.5452 63.7819 12.514 64.2781 11.6146C64.7743 10.6997 65.4489 9.97865 66.3017 9.45142C67.1701 8.92419 68.1393 8.66057 69.2093 8.66057C70.0621 8.66057 70.8065 8.82339 71.4422 9.14903C72.0935 9.45917 72.613 9.90111 73.0007 10.4749V3.75267H76.1408V20.5H73.3496L73.0007 18.895C72.7526 19.2362 72.4579 19.5541 72.1168 19.8487C71.7756 20.1278 71.3647 20.3527 70.884 20.5233C70.4033 20.6938 69.845 20.7791 69.2093 20.7791ZM69.9071 18.0344C70.5273 18.0344 71.0778 17.8949 71.5585 17.6157C72.0393 17.3211 72.4114 16.9257 72.675 16.4295C72.9386 15.9333 73.0705 15.3673 73.0705 14.7315C73.0705 14.0802 72.9386 13.5064 72.675 13.0102C72.4114 12.4985 72.0393 12.1031 71.5585 11.824C71.0778 11.5448 70.5273 11.4053 69.9071 11.4053C69.3023 11.4053 68.7596 11.5526 68.2789 11.8472C67.7981 12.1263 67.4182 12.514 67.1391 13.0102C66.8755 13.5064 66.7437 14.0724 66.7437 14.7082C66.7437 15.3595 66.8755 15.9333 67.1391 16.4295C67.4027 16.9257 67.7749 17.3211 68.2556 17.6157C68.7518 17.8949 69.3023 18.0344 69.9071 18.0344ZM84.4738 20.7791C83.3883 20.7791 82.4191 20.5155 81.5662 19.9883C80.7134 19.461 80.0388 18.74 79.5426 17.8251C79.0464 16.8947 78.7983 15.8557 78.7983 14.7082C78.7983 13.5452 79.0464 12.514 79.5426 11.6146C80.0388 10.6997 80.7134 9.97865 81.5662 9.45142C82.4346 8.92419 83.4038 8.66057 84.4738 8.66057C85.3266 8.66057 86.071 8.82339 86.7067 9.14903C87.358 9.45917 87.8775 9.90111 88.2652 10.4749V3.75267H91.4053V20.5H88.6141L88.2652 18.895C88.0171 19.2362 87.7224 19.5541 87.3813 19.8487C87.0401 20.1278 86.6292 20.3527 86.1485 20.5233C85.6678 20.6938 85.1095 20.7791 84.4738 20.7791ZM85.1716 18.0344C85.7918 18.0344 86.3423 17.8949 86.823 17.6157C87.3037 17.3211 87.6759 16.9257 87.9395 16.4295C88.2031 15.9333 88.3349 15.3673 88.3349 14.7315C88.3349 14.0802 88.2031 13.5064 87.9395 13.0102C87.6759 12.4985 87.3037 12.1031 86.823 11.824C86.3423 11.5448 85.7918 11.4053 85.1716 11.4053C84.5668 11.4053 84.0241 11.5526 83.5433 11.8472C83.0626 12.1263 82.6827 12.514 82.4036 13.0102C82.14 13.5064 82.0082 14.0724 82.0082 14.7082C82.0082 15.3595 82.14 15.9333 82.4036 16.4295C82.6672 16.9257 83.0394 17.3211 83.5201 17.6157C84.0163 17.8949 84.5668 18.0344 85.1716 18.0344ZM94.528 20.5V8.93969H97.6681V20.5H94.528ZM96.0864 7.28822C95.5282 7.28822 95.063 7.11765 94.6908 6.7765C94.3341 6.43535 94.1558 6.01666 94.1558 5.52045C94.1558 4.99322 94.3341 4.56678 94.6908 4.24114C95.063 3.9155 95.5282 3.75267 96.0864 3.75267C96.6602 3.75267 97.1254 3.9155 97.482 4.24114C97.8542 4.56678 98.0403 4.99322 98.0403 5.52045C98.0403 6.01666 97.8542 6.43535 97.482 6.7765C97.1254 7.11765 96.6602 7.28822 96.0864 7.28822ZM106.006 20.5C105.184 20.5 104.463 20.3759 103.843 20.1278C103.238 19.8642 102.765 19.4378 102.424 18.8485C102.083 18.2438 101.912 17.4219 101.912 16.3829V11.5681H99.9351V8.93969H101.912L102.261 5.79957H105.052V8.93969H108.123V11.5681H105.052V16.4295C105.052 16.9567 105.169 17.3211 105.401 17.5227C105.634 17.7243 106.029 17.8251 106.587 17.8251H108.053V20.5H106.006Z"
                        class="fill-primary-500"></path>
                      <defs>
                        <clipPath id=":r4:">
                          <rect width="24" height="24" class="fill-primary-500" transform="translate(0.5 1)"></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 80 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M37.9217 20.2939V4.01182H41.6666L46.7373 14.1533L51.7383 4.01182H55.4831V20.2939H52.343V9.3384L47.9468 17.9679H45.458L41.0618 9.31514V20.2939H37.9217ZM64.9424 20.5731C63.7484 20.5731 62.6629 20.3327 61.686 19.852C60.7091 19.3713 59.9337 18.6502 59.36 17.6888C58.7862 16.7274 58.4993 15.5023 58.4993 14.0137V4.01182H61.6395V14.037C61.6395 14.8433 61.7713 15.5256 62.0349 16.0839C62.2985 16.6266 62.6862 17.0298 63.1979 17.2934C63.7096 17.557 64.3066 17.6888 64.9889 17.6888C65.7022 17.6888 66.307 17.557 66.8032 17.2934C67.3149 17.0298 67.7026 16.6266 67.9662 16.0839C68.2453 15.5256 68.3849 14.8433 68.3849 14.037V4.01182H71.525V14.0137C71.525 15.5023 71.2226 16.7274 70.6179 17.6888C70.0286 18.6502 69.2378 19.3713 68.2453 19.852C67.2529 20.3327 66.1519 20.5731 64.9424 20.5731ZM74.5156 20.2939V4.01182H77.6557V20.2939H74.5156Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M9.15706 7.14137L1.18999 2.51105C1.01476 2.41004 0.789629 2.46967 0.687409 2.64491C0.654553 2.7021 0.637516 2.76781 0.638733 2.83353V15.7181C0.638733 15.8507 0.711747 15.9676 0.822486 16.0345L3.79903 17.7844C3.97427 17.8854 4.19939 17.8258 4.30161 17.6493C4.33325 17.5946 4.35029 17.5313 4.35029 17.468V9.0592C4.35151 8.97767 4.41844 8.91318 4.49997 8.91439C4.52552 8.91439 4.54986 8.92169 4.57055 8.93386L9.16436 11.5648C9.6207 11.8252 10.1805 11.8228 10.6344 11.5575L15.1175 8.93386C15.188 8.89371 15.2781 8.91683 15.3182 8.98741C15.3304 9.00931 15.3377 9.03365 15.3377 9.05799V13.1736C15.3377 13.4291 15.2026 13.6652 14.9848 13.7978L10.3691 16.6344C10.2584 16.7014 10.1914 16.8218 10.1926 16.9508V21.0968C10.1926 21.2295 10.2584 21.3463 10.3618 21.4132L16.411 25.2355C16.882 25.5324 17.4782 25.5373 17.9541 25.2501L25.6425 20.6928C26.0915 20.4263 26.3653 19.9432 26.3629 19.4211V11.476C26.3629 11.2728 26.201 11.1073 25.9978 11.106C25.9296 11.106 25.8627 11.1243 25.8043 11.1596L23.3717 12.6296C22.9324 12.8937 22.6623 13.367 22.6586 13.8794V17.8708C22.6586 18.001 22.588 18.1215 22.4749 18.1872L17.9249 20.8705C17.4612 21.1418 16.8868 21.1394 16.4256 20.8632L13.9784 19.3932C13.8056 19.2873 13.7509 19.0609 13.8567 18.8881C13.8835 18.8431 13.92 18.8054 13.9638 18.7762L18.3885 15.858C18.801 15.5867 19.0505 15.1255 19.0505 14.6302V2.83353C19.0493 2.6303 18.8838 2.46724 18.6805 2.46845C18.6173 2.46845 18.554 2.48549 18.4992 2.51713L10.6344 7.14015C10.178 7.40543 9.6134 7.40543 9.15706 7.14015V7.14137Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M26.2688 3.18067V5.6948C26.2688 6.20225 26.0084 6.67562 25.5776 6.94456L23.1523 8.45108C22.9795 8.55695 22.7532 8.50219 22.6473 8.32818C22.612 8.26977 22.5938 8.20283 22.5938 8.13469V5.50374C22.5938 4.97926 22.8749 4.49493 23.3288 4.23208L25.7175 2.8655C25.8928 2.76449 26.1179 2.82412 26.2201 3.00057C26.2518 3.05533 26.2688 3.11861 26.2688 3.18189V3.18067Z"
                        class="fill-primary-500"
                      />
                    </svg>

                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 132 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M34.5584 20.3779V4.09581H40.2107C42.1025 4.09581 43.6609 4.43696 44.8859 5.11926C46.1265 5.78605 47.0414 6.73196 47.6306 7.957C48.2354 9.16653 48.5378 10.5931 48.5378 12.2369C48.5378 13.8806 48.2354 15.315 47.6306 16.54C47.0414 17.7495 46.1265 18.6954 44.8859 19.3777C43.6609 20.0445 42.1025 20.3779 40.2107 20.3779H34.5584ZM37.6986 17.6797H40.0246C41.3737 17.6797 42.4281 17.4627 43.188 17.0285C43.9633 16.5943 44.5138 15.974 44.8394 15.1677C45.1651 14.3458 45.3279 13.3689 45.3279 12.2369C45.3279 11.0894 45.1651 10.1124 44.8394 9.30609C44.5138 8.48423 43.9633 7.8562 43.188 7.42201C42.4281 6.98782 41.3737 6.77073 40.0246 6.77073H37.6986V17.6797ZM51.0939 20.3779V8.81762H53.8851L54.1875 10.9808C54.4666 10.4846 54.8077 10.0582 55.2109 9.70151C55.6296 9.32935 56.1026 9.04247 56.6298 8.84088C57.1725 8.6393 57.7695 8.5385 58.4208 8.5385V11.8647H57.5369C57.0562 11.8647 56.6065 11.919 56.1879 12.0275C55.7847 12.1361 55.4358 12.3144 55.1411 12.5625C54.8465 12.8106 54.6217 13.1518 54.4666 13.586C54.3115 14.0046 54.234 14.5396 54.234 15.1909V20.3779H51.0939ZM60.5455 20.3779V8.81762H63.6856V20.3779H60.5455ZM62.1039 7.16615C61.5457 7.16615 61.0805 6.99558 60.7083 6.65443C60.3517 6.31328 60.1733 5.89459 60.1733 5.39838C60.1733 4.87115 60.3517 4.44471 60.7083 4.11907C61.0805 3.79342 61.5457 3.6306 62.1039 3.6306C62.6777 3.6306 63.1429 3.79342 63.4995 4.11907C63.8717 4.44471 64.0578 4.87115 64.0578 5.39838C64.0578 5.89459 63.8717 6.31328 63.4995 6.65443C63.1429 6.99558 62.6777 7.16615 62.1039 7.16615ZM73.7215 20.6571C73.1477 20.6571 72.6205 20.5873 72.1398 20.4477C71.6746 20.3081 71.2559 20.1066 70.8837 19.8429C70.5116 19.5638 70.1937 19.2382 69.9301 18.866L69.5812 20.3779H66.7899V3.6306H69.9301V10.4458C70.2867 9.93411 70.7674 9.49217 71.3722 9.12C71.977 8.73234 72.7601 8.5385 73.7215 8.5385C74.807 8.5385 75.7684 8.80212 76.6057 9.32935C77.4586 9.85658 78.1332 10.5776 78.6294 11.4925C79.1256 12.4074 79.3737 13.4542 79.3737 14.6327C79.3737 15.7802 79.1256 16.8114 78.6294 17.7263C78.1332 18.6412 77.4586 19.3622 76.6057 19.8895C75.7684 20.4012 74.807 20.6571 73.7215 20.6571ZM73.0237 17.9124C73.6439 17.9124 74.1867 17.7728 74.6519 17.4937C75.1326 17.2145 75.5048 16.8269 75.7684 16.3307C76.0475 15.8344 76.1871 15.2607 76.1871 14.6094C76.1871 13.9736 76.0475 13.4076 75.7684 12.9114C75.5048 12.3997 75.1326 12.0043 74.6519 11.7251C74.1867 11.4305 73.6439 11.2832 73.0237 11.2832C72.4034 11.2832 71.8529 11.4305 71.3722 11.7251C70.8915 12.0043 70.5116 12.3919 70.2325 12.8882C69.9688 13.3844 69.837 13.9581 69.837 14.6094C69.837 15.2452 69.9688 15.8189 70.2325 16.3307C70.5116 16.8269 70.8915 17.2145 71.3722 17.4937C71.8529 17.7728 72.4034 17.9124 73.0237 17.9124ZM88.9633 20.6571C88.3895 20.6571 87.8623 20.5873 87.3816 20.4477C86.9164 20.3081 86.4977 20.1066 86.1255 19.8429C85.7533 19.5638 85.4355 19.2382 85.1718 18.866L84.8229 20.3779H82.0317V3.6306H85.1718V10.4458C85.5285 9.93411 86.0092 9.49217 86.614 9.12C87.2187 8.73234 88.0018 8.5385 88.9633 8.5385C90.0487 8.5385 91.0101 8.80212 91.8475 9.32935C92.7004 9.85658 93.3749 10.5776 93.8711 11.4925C94.3674 12.4074 94.6155 13.4542 94.6155 14.6327C94.6155 15.7802 94.3674 16.8114 93.8711 17.7263C93.3749 18.6412 92.7004 19.3622 91.8475 19.8895C91.0101 20.4012 90.0487 20.6571 88.9633 20.6571ZM88.2654 17.9124C88.8857 17.9124 89.4285 17.7728 89.8937 17.4937C90.3744 17.2145 90.7465 16.8269 91.0101 16.3307C91.2893 15.8344 91.4288 15.2607 91.4288 14.6094C91.4288 13.9736 91.2893 13.4076 91.0101 12.9114C90.7465 12.3997 90.3744 12.0043 89.8937 11.7251C89.4285 11.4305 88.8857 11.2832 88.2654 11.2832C87.6452 11.2832 87.0947 11.4305 86.614 11.7251C86.1333 12.0043 85.7533 12.3919 85.4742 12.8882C85.2106 13.3844 85.0788 13.9581 85.0788 14.6094C85.0788 15.2452 85.2106 15.8189 85.4742 16.3307C85.7533 16.8269 86.1333 17.2145 86.614 17.4937C87.0947 17.7728 87.6452 17.9124 88.2654 17.9124ZM104.205 20.6571C103.631 20.6571 103.104 20.5873 102.623 20.4477C102.158 20.3081 101.739 20.1066 101.367 19.8429C100.995 19.5638 100.677 19.2382 100.414 18.866L100.065 20.3779H97.2735V3.6306H100.414V10.4458C100.77 9.93411 101.251 9.49217 101.856 9.12C102.461 8.73234 103.244 8.5385 104.205 8.5385C105.29 8.5385 106.252 8.80212 107.089 9.32935C107.942 9.85658 108.617 10.5776 109.113 11.4925C109.609 12.4074 109.857 13.4542 109.857 14.6327C109.857 15.7802 109.609 16.8114 109.113 17.7263C108.617 18.6412 107.942 19.3622 107.089 19.8895C106.252 20.4012 105.29 20.6571 104.205 20.6571ZM103.507 17.9124C104.127 17.9124 104.67 17.7728 105.135 17.4937C105.616 17.2145 105.988 16.8269 106.252 16.3307C106.531 15.8344 106.671 15.2607 106.671 14.6094C106.671 13.9736 106.531 13.4076 106.252 12.9114C105.988 12.3997 105.616 12.0043 105.135 11.7251C104.67 11.4305 104.127 11.2832 103.507 11.2832C102.887 11.2832 102.336 11.4305 101.856 11.7251C101.375 12.0043 100.995 12.3919 100.716 12.8882C100.452 13.3844 100.321 13.9581 100.321 14.6094C100.321 15.2452 100.452 15.8189 100.716 16.3307C100.995 16.8269 101.375 17.2145 101.856 17.4937C102.336 17.7728 102.887 17.9124 103.507 17.9124ZM112.515 20.3779V3.6306H115.655V20.3779H112.515ZM124.323 20.6571C123.145 20.6571 122.098 20.4089 121.183 19.9127C120.284 19.4165 119.578 18.7187 119.066 17.8193C118.555 16.9199 118.299 15.881 118.299 14.7024C118.299 13.5084 118.547 12.4462 119.043 11.5158C119.555 10.5854 120.26 9.85658 121.16 9.32935C122.075 8.80212 123.137 8.5385 124.347 8.5385C125.494 8.5385 126.502 8.79436 127.37 9.30609C128.254 9.8023 128.937 10.4768 129.417 11.3297C129.913 12.1826 130.162 13.1595 130.162 14.2605C130.162 14.4156 130.162 14.5861 130.162 14.7722C130.162 14.9583 130.146 15.1599 130.115 15.377H120.555V13.4464H126.975C126.928 12.7331 126.657 12.1671 126.161 11.7484C125.68 11.3142 125.075 11.0971 124.347 11.0971C123.804 11.0971 123.308 11.2212 122.858 11.4693C122.408 11.7019 122.052 12.0585 121.788 12.5393C121.524 13.02 121.392 13.6247 121.392 14.3535V15.0281C121.392 15.6484 121.517 16.1911 121.765 16.6563C122.013 17.106 122.354 17.4627 122.788 17.7263C123.238 17.9744 123.742 18.0984 124.3 18.0984C124.874 18.0984 125.354 17.9744 125.742 17.7263C126.13 17.4627 126.424 17.1293 126.626 16.7261H129.836C129.603 17.4549 129.231 18.1217 128.719 18.7265C128.208 19.3157 127.58 19.7887 126.835 20.1453C126.091 20.4865 125.254 20.6571 124.323 20.6571Z"
                        class="fill-primary-500"
                      />
                      <g clipPath="url(#clip0_10969_1027)">
                        <path
                          d="M0 12.1836C0 10.0983 0.513682 8.17393 1.541 6.41059C2.56834 4.64725 3.96368 3.25193 5.727 2.22459C7.49034 1.19725 9.41468 0.683594 11.5 0.683594C13.5853 0.683594 15.5097 1.19725 17.273 2.22459C19.0363 3.25193 20.4317 4.64725 21.459 6.41059C22.4863 8.17393 23 10.0983 23 12.1836C23 14.2689 22.4863 16.1933 21.459 17.9566C20.4317 19.7199 19.0363 21.1153 17.273 22.1426C15.5097 23.1699 13.5853 23.6836 11.5 23.6836C9.41468 23.6836 7.49034 23.1699 5.727 22.1426C3.96368 21.1153 2.56834 19.7199 1.541 17.9566C0.513682 16.1933 0 14.2689 0 12.1836ZM1.909 12.1836C1.909 14.5756 2.714 16.6839 4.324 18.5086C5.06 17.0673 6.22534 15.6949 7.82 14.3916C9.41468 13.0883 10.971 12.2679 12.489 11.9306C12.259 11.3939 12.0367 10.9109 11.822 10.4816C9.18468 11.3249 6.33268 11.7466 3.266 11.7466C2.668 11.7466 2.22334 11.7389 1.932 11.7236C1.932 11.7849 1.92818 11.8616 1.9205 11.9536C1.91284 12.0456 1.909 12.1223 1.909 12.1836ZM2.208 9.81459C2.54534 9.84525 3.04368 9.86059 3.703 9.86059C6.26368 9.86059 8.694 9.51559 10.994 8.82559C9.82868 6.75559 8.54834 5.03059 7.153 3.65059C5.94168 4.26393 4.90284 5.11493 4.0365 6.20359C3.17018 7.29225 2.56068 8.49593 2.208 9.81459ZM5.635 19.7506C7.36768 21.0999 9.32268 21.7746 11.5 21.7746C12.6347 21.7746 13.7617 21.5599 14.881 21.1306C14.5743 18.5086 13.9763 15.9709 13.087 13.5176C11.6763 13.8243 10.2542 14.5986 8.8205 15.8406C7.38684 17.0826 6.325 18.3859 5.635 19.7506ZM9.154 2.91459C10.5033 4.30993 11.753 6.05025 12.903 8.13559C14.9883 7.26159 16.56 6.14993 17.618 4.80059C15.8393 3.32859 13.8 2.59259 11.5 2.59259C10.718 2.59259 9.936 2.69993 9.154 2.91459ZM13.731 9.76859C13.961 10.2593 14.2217 10.8803 14.513 11.6316C15.6477 11.5243 16.882 11.4706 18.216 11.4706C19.1667 11.4706 20.1097 11.4936 21.045 11.5396C20.9223 9.45425 20.171 7.59893 18.791 5.97359C17.7943 7.46093 16.1077 8.72593 13.731 9.76859ZM15.088 13.2416C15.87 15.5109 16.399 17.8416 16.675 20.2336C17.8863 19.4516 18.8753 18.4473 19.642 17.2206C20.4087 15.9939 20.8687 14.6676 21.022 13.2416C19.9027 13.1649 18.883 13.1266 17.963 13.1266C17.1197 13.1266 16.1613 13.1649 15.088 13.2416Z"
                          class="fill-primary-500"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_10969_1027">
                          <rect width="23" height="23" class="fill-secondary-100" transform="translate(0 0.683594)" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 106 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M41.3152 20.7791C40.2298 20.7791 39.2606 20.5155 38.4077 19.9883C37.5548 19.461 36.8803 18.74 36.3841 17.8251C35.8879 16.8947 35.6397 15.8557 35.6397 14.7082C35.6397 13.5452 35.8879 12.514 36.3841 11.6146C36.8803 10.6997 37.5548 9.97865 38.4077 9.45142C39.2761 8.92419 40.2453 8.66057 41.3152 8.66057C42.1681 8.66057 42.9124 8.82339 43.5482 9.14903C44.1995 9.45917 44.719 9.90111 45.1066 10.4749V3.75267H48.2468V20.5H45.4555L45.1066 18.895C44.8585 19.2362 44.5639 19.5541 44.2228 19.8487C43.8816 20.1278 43.4707 20.3527 42.99 20.5233C42.5093 20.6938 41.951 20.7791 41.3152 20.7791ZM42.013 18.0344C42.6333 18.0344 43.1838 17.8949 43.6645 17.6157C44.1452 17.3211 44.5174 16.9257 44.781 16.4295C45.0446 15.9333 45.1764 15.3673 45.1764 14.7315C45.1764 14.0802 45.0446 13.5064 44.781 13.0102C44.5174 12.4985 44.1452 12.1031 43.6645 11.824C43.1838 11.5448 42.6333 11.4053 42.013 11.4053C41.4083 11.4053 40.8655 11.5526 40.3848 11.8472C39.9041 12.1263 39.5242 12.514 39.2451 13.0102C38.9815 13.5064 38.8497 14.0724 38.8497 14.7082C38.8497 15.3595 38.9815 15.9333 39.2451 16.4295C39.5087 16.9257 39.8809 17.3211 40.3616 17.6157C40.8578 17.8949 41.4083 18.0344 42.013 18.0344ZM56.9286 20.7791C55.7501 20.7791 54.7034 20.531 53.7885 20.0348C52.8891 19.5386 52.1835 18.8408 51.6718 17.9414C51.1601 17.042 50.9042 16.003 50.9042 14.8245C50.9042 13.6305 51.1523 12.5683 51.6486 11.6379C52.1603 10.7075 52.8658 9.97865 53.7652 9.45142C54.6801 8.92419 55.7424 8.66057 56.9519 8.66057C58.0994 8.66057 59.1073 8.91643 59.9757 9.42816C60.8596 9.92437 61.5419 10.5989 62.0226 11.4518C62.5188 12.3047 62.7669 13.2816 62.7669 14.3826C62.7669 14.5376 62.7669 14.7082 62.7669 14.8943C62.7669 15.0804 62.7514 15.282 62.7204 15.4991H53.1605V13.5685H59.5803C59.5338 12.8552 59.2624 12.2892 58.7662 11.8705C58.2855 11.4363 57.6807 11.2192 56.9519 11.2192C56.4091 11.2192 55.9129 11.3432 55.4632 11.5914C55.0135 11.824 54.6569 12.1806 54.3933 12.6613C54.1296 13.142 53.9978 13.7468 53.9978 14.4756V15.1502C53.9978 15.7704 54.1219 16.3132 54.37 16.7784C54.6181 17.2281 54.9593 17.5847 55.3935 17.8483C55.8431 18.0964 56.3471 18.2205 56.9054 18.2205C57.4791 18.2205 57.9598 18.0964 58.3475 17.8483C58.7352 17.5847 59.0298 17.2513 59.2314 16.8482H62.4413C62.2087 17.577 61.8365 18.2438 61.3248 18.8485C60.8131 19.4378 60.185 19.9107 59.4407 20.2674C58.6964 20.6085 57.859 20.7791 56.9286 20.7791ZM67.9082 20.5L63.6748 8.93969H66.9777L69.8155 17.546L72.6765 8.93969H75.9329L71.6996 20.5H67.9082ZM78.2486 20.6163C77.6748 20.6163 77.2019 20.4457 76.8297 20.1046C76.473 19.7479 76.2947 19.3137 76.2947 18.802C76.2947 18.2903 76.473 17.8638 76.8297 17.5227C77.2019 17.166 77.6748 16.9877 78.2486 16.9877C78.8223 16.9877 79.2875 17.166 79.6442 17.5227C80.0008 17.8638 80.1792 18.2903 80.1792 18.802C80.1792 19.3137 80.0008 19.7479 79.6442 20.1046C79.2875 20.4457 78.8223 20.6163 78.2486 20.6163ZM87.8567 20.5C87.0348 20.5 86.3137 20.3759 85.6935 20.1278C85.0887 19.8642 84.6157 19.4378 84.2746 18.8485C83.9334 18.2438 83.7629 17.4219 83.7629 16.3829V11.5681H81.7858V8.93969H83.7629L84.1118 5.79957H86.903V8.93969H89.9733V11.5681H86.903V16.4295C86.903 16.9567 87.0193 17.3211 87.2519 17.5227C87.4845 17.7243 87.8799 17.8251 88.4382 17.8251H89.9036V20.5H87.8567ZM97.7902 20.7791C96.6892 20.7791 95.689 20.5233 94.7896 20.0115C93.9058 19.4998 93.2002 18.7865 92.673 17.8716C92.1457 16.9567 91.8821 15.91 91.8821 14.7315C91.8821 13.5375 92.1457 12.483 92.673 11.5681C93.2002 10.6532 93.9135 9.93988 94.8129 9.42816C95.7123 8.91643 96.7125 8.66057 97.8135 8.66057C98.9455 8.66057 99.9534 8.91643 100.837 9.42816C101.737 9.93988 102.442 10.6532 102.954 11.5681C103.481 12.483 103.745 13.5375 103.745 14.7315C103.745 15.91 103.481 16.9567 102.954 17.8716C102.442 18.7865 101.737 19.4998 100.837 20.0115C99.9379 20.5233 98.9222 20.7791 97.7902 20.7791ZM97.8135 18.0577C98.3097 18.0577 98.7594 17.9336 99.1626 17.6855C99.5812 17.4374 99.9146 17.0652 100.163 16.569C100.426 16.0728 100.558 15.4603 100.558 14.7315C100.558 13.9872 100.434 13.3669 100.186 12.8707C99.9379 12.3744 99.6045 12.0023 99.1858 11.7542C98.7826 11.5061 98.3329 11.382 97.8367 11.382C97.3405 11.382 96.8831 11.5061 96.4644 11.7542C96.0457 12.0023 95.7123 12.3744 95.4642 12.8707C95.2161 13.3669 95.092 13.9872 95.092 14.7315C95.092 15.4603 95.2161 16.0728 95.4642 16.569C95.7123 17.0652 96.0379 17.4374 96.4411 17.6855C96.8598 17.9336 97.3173 18.0577 97.8135 18.0577Z"
                        class="fill-primary-500"
                      />
                      <g clip-path="url(#clip0_10973_27015)">
                        <path
                          d="M7.47938 10.6561C7.28018 10.5072 7.08047 10.4327 6.88127 10.4327H5.98592V15.7962H6.88179C7.08098 15.7962 7.28069 15.7217 7.47989 15.5728C7.67908 15.424 7.77868 15.2006 7.77868 14.9023V11.3266C7.77817 11.0288 7.67806 10.805 7.47938 10.6561ZM22.0587 1.60547H3.56629C2.32388 1.60547 1.31558 2.61121 1.3125 3.85413V22.3568C1.31558 23.5997 2.32388 24.6055 3.56629 24.6055H22.0587C23.3016 24.6055 24.3094 23.5997 24.3125 22.3568V3.85413C24.3094 2.61121 23.3011 1.60547 22.0587 1.60547ZM9.22902 14.9121C9.22902 15.8778 8.63297 17.341 6.74625 17.3379H4.36411V8.84328H6.79656C8.61603 8.84328 9.22799 10.3044 9.2285 11.2706L9.22902 14.9121ZM14.3979 10.3604H11.6625V12.3328H13.3346V13.8509H11.6625V15.8229H14.3984V17.341H11.2061C10.6331 17.3558 10.1567 16.903 10.1423 16.3301V9.90703C10.1285 9.3346 10.5818 8.8592 11.1542 8.84482H14.3984L14.3979 10.3604ZM19.7187 16.2793C19.041 17.8579 17.8268 17.5438 17.2831 16.2793L15.305 8.84534H16.9771L18.5024 14.6836L20.0205 8.84534H21.6932L19.7187 16.2793Z"
                          class="fill-primary-500"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0_10973_27015">
                          <rect width="24" height="24" class="fill-primary-500" transform="translate(0.5 1.5)" />
                        </clipPath>
                      </defs>
                    </svg>

                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 106 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M34.2891 20.7791C33.1106 20.7791 32.0639 20.531 31.149 20.0348C30.2496 19.5386 29.5441 18.8408 29.0323 17.9414C28.5206 17.042 28.2647 16.003 28.2647 14.8245C28.2647 13.6305 28.5129 12.5683 29.0091 11.6379C29.5208 10.7075 30.2264 9.97865 31.1258 9.45142C32.0407 8.92419 33.1029 8.66057 34.3124 8.66057C35.4599 8.66057 36.4678 8.91643 37.3362 9.42816C38.2201 9.92437 38.9024 10.5989 39.3831 11.4518C39.8793 12.3047 40.1274 13.2816 40.1274 14.3826C40.1274 14.5376 40.1274 14.7082 40.1274 14.8943C40.1274 15.0804 40.1119 15.282 40.0809 15.4991H30.521V13.5685H36.9408C36.8943 12.8552 36.6229 12.2892 36.1267 11.8705C35.646 11.4363 35.0412 11.2192 34.3124 11.2192C33.7697 11.2192 33.2734 11.3432 32.8237 11.5914C32.374 11.824 32.0174 12.1806 31.7538 12.6613C31.4902 13.142 31.3584 13.7468 31.3584 14.4756V15.1502C31.3584 15.7704 31.4824 16.3132 31.7305 16.7784C31.9786 17.2281 32.3198 17.5847 32.754 17.8483C33.2037 18.0964 33.7076 18.2205 34.2659 18.2205C34.8396 18.2205 35.3203 18.0964 35.708 17.8483C36.0957 17.5847 36.3903 17.2513 36.5919 16.8482H39.8018C39.5692 17.577 39.197 18.2438 38.6853 18.8485C38.1736 19.4378 37.5456 19.9107 36.8012 20.2674C36.0569 20.6085 35.2195 20.7791 34.2891 20.7791ZM42.6294 20.5V8.93969H45.3973L45.6299 10.8703C45.9866 10.219 46.4983 9.69177 47.1651 9.2886C47.8319 8.86991 48.6305 8.66057 49.5609 8.66057C50.5223 8.66057 51.3364 8.86991 52.0032 9.2886C52.67 9.69177 53.1817 10.2888 53.5384 11.0796C53.895 11.8705 54.0734 12.8474 54.0734 14.0104V20.5H50.9332V14.2895C50.9332 13.3436 50.7394 12.6148 50.3517 12.1031C49.9641 11.5758 49.3515 11.3122 48.5142 11.3122C47.987 11.3122 47.514 11.444 47.0953 11.7077C46.6766 11.9558 46.351 12.3202 46.1184 12.8009C45.8858 13.2661 45.7695 13.8398 45.7695 14.5221V20.5H42.6294ZM59.9198 20.5L55.6865 8.93969H58.9894L61.8272 17.546L64.6882 8.93969H67.9446L63.7113 20.5H59.9198ZM73.0926 20.7791C72.1156 20.7791 71.3015 20.6241 70.6502 20.3139C70.0145 20.0038 69.5415 19.5851 69.2314 19.0579C68.9212 18.5151 68.7662 17.9259 68.7662 17.2901C68.7662 16.5923 68.9445 15.972 69.3011 15.4293C69.6733 14.8865 70.2316 14.4679 70.9759 14.1732C71.7202 13.8631 72.6584 13.708 73.7904 13.708H76.6979C76.6979 13.1498 76.6126 12.6923 76.442 12.3357C76.287 11.9635 76.0388 11.6844 75.6977 11.4983C75.3721 11.3122 74.9534 11.2192 74.4416 11.2192C73.8369 11.2192 73.3174 11.351 72.8832 11.6146C72.4645 11.8782 72.2087 12.2814 72.1156 12.8241H69.0685C69.1461 11.9713 69.4252 11.2425 69.9059 10.6377C70.3866 10.0174 71.0224 9.5367 71.8132 9.19555C72.6041 8.8389 73.4802 8.66057 74.4416 8.66057C75.5426 8.66057 76.4963 8.84665 77.3026 9.21882C78.109 9.59098 78.7293 10.126 79.1635 10.8238C79.6132 11.5216 79.838 12.3744 79.838 13.3824V20.5H77.1863L76.8374 18.709C76.6824 19.0191 76.4808 19.2982 76.2327 19.5463C76.0001 19.7944 75.7287 20.0115 75.4186 20.1976C75.1084 20.3837 74.7595 20.5233 74.3719 20.6163C73.9842 20.7248 73.5578 20.7791 73.0926 20.7791ZM73.8369 18.3601C74.2556 18.3601 74.62 18.2903 74.9301 18.1507C75.2558 17.9957 75.5271 17.7941 75.7442 17.546C75.9768 17.2978 76.1551 17.011 76.2792 16.6853C76.4188 16.3442 76.5118 15.9953 76.5583 15.6386V15.6154H74.1393C73.6586 15.6154 73.2631 15.6774 72.953 15.8014C72.6584 15.9255 72.4413 16.0961 72.3017 16.3132C72.1621 16.5148 72.0924 16.7551 72.0924 17.0342C72.0924 17.3134 72.1621 17.5537 72.3017 17.7553C72.4413 17.9569 72.6429 18.112 72.9065 18.2205C73.1701 18.3135 73.4802 18.3601 73.8369 18.3601ZM87.7732 20.5C86.9513 20.5 86.2303 20.3759 85.61 20.1278C85.0052 19.8642 84.5323 19.4378 84.1911 18.8485C83.85 18.2438 83.6794 17.4219 83.6794 16.3829V11.5681H81.7023V8.93969H83.6794L84.0283 5.79957H86.8195V8.93969H89.8899V11.5681H86.8195V16.4295C86.8195 16.9567 86.9358 17.3211 87.1684 17.5227C87.401 17.7243 87.7964 17.8251 88.3547 17.8251H89.8201V20.5H87.7732ZM97.7067 20.7791C96.6057 20.7791 95.6056 20.5233 94.7062 20.0115C93.8223 19.4998 93.1167 18.7865 92.5895 17.8716C92.0623 16.9567 91.7986 15.91 91.7986 14.7315C91.7986 13.5375 92.0623 12.483 92.5895 11.5681C93.1167 10.6532 93.83 9.93988 94.7294 9.42816C95.6288 8.91643 96.629 8.66057 97.73 8.66057C98.862 8.66057 99.8699 8.91643 100.754 9.42816C101.653 9.93988 102.359 10.6532 102.87 11.5681C103.398 12.483 103.661 13.5375 103.661 14.7315C103.661 15.91 103.398 16.9567 102.87 17.8716C102.359 18.7865 101.653 19.4998 100.754 20.0115C99.8544 20.5233 98.8387 20.7791 97.7067 20.7791ZM97.73 18.0577C98.2262 18.0577 98.6759 17.9336 99.0791 17.6855C99.4978 17.4374 99.8312 17.0652 100.079 16.569C100.343 16.0728 100.475 15.4603 100.475 14.7315C100.475 13.9872 100.351 13.3669 100.103 12.8707C99.8544 12.3744 99.521 12.0023 99.1023 11.7542C98.6992 11.5061 98.2495 11.382 97.7532 11.382C97.257 11.382 96.7996 11.5061 96.3809 11.7542C95.9622 12.0023 95.6288 12.3744 95.3807 12.8707C95.1326 13.3669 95.0085 13.9872 95.0085 14.7315C95.0085 15.4603 95.1326 16.0728 95.3807 16.569C95.6288 17.0652 95.9545 17.4374 96.3576 17.6855C96.7763 17.9336 97.2338 18.0577 97.73 18.0577Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M10.0537 24C10.623 24 11.0821 23.541 11.0821 22.9717C11.0821 22.4024 10.623 21.9434 10.0537 21.9434C9.48447 21.9434 9.02539 22.4024 9.02539 22.9717C9.02539 23.541 9.48447 24 10.0537 24Z"
                        class="fill-primary-500"
                      />
                      <path
                        d="M15.9605 15.9692L10.17 16.5874C10.0659 16.5997 10.0109 16.465 10.0965 16.3977L15.7646 11.9844C16.1319 11.6845 16.3645 11.2131 16.2666 10.7112C16.1686 9.93996 15.532 9.43804 14.7302 9.54209L8.57241 10.4419C8.46223 10.4603 8.40714 10.3195 8.49284 10.2521L14.5955 5.5879C15.8014 4.65138 15.8993 2.80894 14.7975 1.73776C13.7937 0.733909 12.1899 0.764515 11.1861 1.76837L1.33733 11.7885C0.97007 12.1925 0.804802 12.725 0.902739 13.2943C1.06801 14.2002 1.97392 14.8001 2.87984 14.6348L8.18066 13.5514C8.29696 13.5269 8.35817 13.6799 8.26024 13.7473L2.37791 17.5117C1.64339 17.983 1.30673 18.8155 1.53933 19.6541C1.77193 20.7558 2.87984 21.3924 3.95102 21.1292L12.747 18.9624C12.8449 18.9379 12.9184 19.0542 12.8571 19.1338L11.486 20.8293C11.1188 21.3006 11.7186 21.9311 12.2206 21.5638L16.7379 17.8484C17.5397 17.1812 17.0072 15.8713 15.9666 15.9753L15.9605 15.9692Z"
                        class="fill-primary-500"
                      />
                    </svg>                

                  </div>
                </div>
              </div>
              <div class="item">
                <div
                  class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                  <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                    <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 110 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#:r4:)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M23.627 13.126C23.627 19.4773 18.4782 24.626 12.127 24.626C5.77568 24.626 0.626953 19.4773 0.626953 13.126C0.626953 6.7747 5.77568 1.62598 12.127 1.62598C18.4782 1.62598 23.627 6.7747 23.627 13.126ZM18.0549 11.508C18.9838 11.4765 19.7615 12.1997 19.7957 13.1259C19.8072 13.7719 19.4441 14.3666 18.8665 14.6554C18.878 14.824 18.878 14.9927 18.8665 15.1614C18.8665 17.7397 15.865 19.8322 12.1633 19.8322C8.46157 19.8322 5.46007 17.7369 5.46007 15.1614C5.44857 14.9927 5.44857 14.824 5.46007 14.6554C5.29141 14.581 5.14012 14.4752 5.00851 14.3523C4.33103 13.7177 4.2996 12.6544 4.93414 11.9797C5.56868 11.3022 6.63205 11.2708 7.30672 11.9053C8.63305 11.0078 10.1909 10.5161 11.7917 10.4903L12.6407 6.49984V6.49422C12.6836 6.29974 12.8753 6.17963 13.0667 6.22256L15.8852 6.7858C16.0651 6.47122 16.391 6.25962 16.7541 6.22256C17.3858 6.15382 17.9516 6.61126 18.0204 7.24299C18.0891 7.87473 17.6317 8.44078 16.9999 8.50927C16.3682 8.57802 15.8022 8.12057 15.7337 7.48884L13.2724 6.97134L12.5264 10.5588C14.1073 10.5931 15.6452 11.0819 16.9545 11.9738C17.2517 11.6909 17.6432 11.5223 18.0549 11.508ZM9.44776 13.1259C8.81322 13.1259 8.29572 13.6434 8.29572 14.2779C8.29572 14.9125 8.81041 15.4241 9.44776 15.43C10.0823 15.43 10.5998 14.9125 10.5998 14.2779C10.5998 13.6434 10.0823 13.1259 9.44776 13.1259ZM14.9762 17.4394V17.4851C15.1019 17.3622 15.1047 17.1565 14.9818 17.0308C14.8586 16.905 14.6529 16.9022 14.5272 17.0251C13.827 17.5253 12.9808 17.7711 12.1232 17.7254C11.2658 17.7655 10.4225 17.5081 9.73066 17.0021C9.61336 16.9078 9.45032 16.9078 9.33609 17.0021C9.20447 17.1108 9.18454 17.3078 9.29315 17.4394C10.1109 18.054 11.1112 18.3686 12.1347 18.3257C13.1582 18.3683 14.1587 18.054 14.9762 17.4394ZM14.7618 15.5128H14.819C15.4536 15.487 15.9481 14.9526 15.9225 14.3178C15.9225 13.6832 15.405 13.1657 14.7705 13.1657C14.1359 13.1657 13.6184 13.6832 13.6184 14.3178C13.6184 14.9523 14.1359 15.4698 14.7705 15.4698L14.7618 15.5128Z"
                          class="fill-primary-500"></path>
                      </g>
                      <path
                        d="M36.0584 20.5V4.21788H42.1526C43.4552 4.21788 44.5329 4.44273 45.3858 4.89242C46.2541 5.34212 46.8977 5.94688 47.3164 6.70672C47.735 7.45104 47.9444 8.28065 47.9444 9.19555C47.9444 10.0639 47.735 10.878 47.3164 11.6379C46.9132 12.3822 46.2774 12.987 45.409 13.4522C44.5561 13.9019 43.4552 14.1267 42.1061 14.1267H39.1986V20.5H36.0584ZM44.5019 20.5L41.1524 13.3359H44.5484L48.0839 20.5H44.5019ZM39.1986 11.8472H41.9665C42.9124 11.8472 43.6102 11.6146 44.0599 11.1494C44.5096 10.6842 44.7345 10.0717 44.7345 9.31186C44.7345 8.55202 44.5096 7.95501 44.0599 7.52082C43.6257 7.07113 42.9202 6.84628 41.9433 6.84628H39.1986V11.8472ZM55.5657 20.7791C54.3872 20.7791 53.3405 20.531 52.4256 20.0348C51.5262 19.5386 50.8206 18.8408 50.3089 17.9414C49.7972 17.042 49.5413 16.003 49.5413 14.8245C49.5413 13.6305 49.7894 12.5683 50.2857 11.6379C50.7974 10.7075 51.5029 9.97865 52.4023 9.45142C53.3172 8.92419 54.3795 8.66057 55.589 8.66057C56.7365 8.66057 57.7444 8.91643 58.6128 9.42816C59.4967 9.92437 60.179 10.5989 60.6597 11.4518C61.1559 12.3047 61.404 13.2816 61.404 14.3826C61.404 14.5376 61.404 14.7082 61.404 14.8943C61.404 15.0804 61.3885 15.282 61.3575 15.4991H51.7976V13.5685H58.2174C58.1709 12.8552 57.8995 12.2892 57.4033 11.8705C56.9226 11.4363 56.3178 11.2192 55.589 11.2192C55.0462 11.2192 54.55 11.3432 54.1003 11.5914C53.6506 11.824 53.294 12.1806 53.0304 12.6613C52.7667 13.142 52.6349 13.7468 52.6349 14.4756V15.1502C52.6349 15.7704 52.759 16.3132 53.0071 16.7784C53.2552 17.2281 53.5964 17.5847 54.0306 17.8483C54.4802 18.0964 54.9842 18.2205 55.5425 18.2205C56.1162 18.2205 56.5969 18.0964 56.9846 17.8483C57.3723 17.5847 57.6669 17.2513 57.8685 16.8482H61.0784C60.8458 17.577 60.4736 18.2438 59.9619 18.8485C59.4502 19.4378 58.8221 19.9107 58.0778 20.2674C57.3335 20.6085 56.4961 20.7791 55.5657 20.7791ZM69.2093 20.7791C68.1238 20.7791 67.1546 20.5155 66.3017 19.9883C65.4489 19.461 64.7743 18.74 64.2781 17.8251C63.7819 16.8947 63.5338 15.8557 63.5338 14.7082C63.5338 13.5452 63.7819 12.514 64.2781 11.6146C64.7743 10.6997 65.4489 9.97865 66.3017 9.45142C67.1701 8.92419 68.1393 8.66057 69.2093 8.66057C70.0621 8.66057 70.8065 8.82339 71.4422 9.14903C72.0935 9.45917 72.613 9.90111 73.0007 10.4749V3.75267H76.1408V20.5H73.3496L73.0007 18.895C72.7526 19.2362 72.4579 19.5541 72.1168 19.8487C71.7756 20.1278 71.3647 20.3527 70.884 20.5233C70.4033 20.6938 69.845 20.7791 69.2093 20.7791ZM69.9071 18.0344C70.5273 18.0344 71.0778 17.8949 71.5585 17.6157C72.0393 17.3211 72.4114 16.9257 72.675 16.4295C72.9386 15.9333 73.0705 15.3673 73.0705 14.7315C73.0705 14.0802 72.9386 13.5064 72.675 13.0102C72.4114 12.4985 72.0393 12.1031 71.5585 11.824C71.0778 11.5448 70.5273 11.4053 69.9071 11.4053C69.3023 11.4053 68.7596 11.5526 68.2789 11.8472C67.7981 12.1263 67.4182 12.514 67.1391 13.0102C66.8755 13.5064 66.7437 14.0724 66.7437 14.7082C66.7437 15.3595 66.8755 15.9333 67.1391 16.4295C67.4027 16.9257 67.7749 17.3211 68.2556 17.6157C68.7518 17.8949 69.3023 18.0344 69.9071 18.0344ZM84.4738 20.7791C83.3883 20.7791 82.4191 20.5155 81.5662 19.9883C80.7134 19.461 80.0388 18.74 79.5426 17.8251C79.0464 16.8947 78.7983 15.8557 78.7983 14.7082C78.7983 13.5452 79.0464 12.514 79.5426 11.6146C80.0388 10.6997 80.7134 9.97865 81.5662 9.45142C82.4346 8.92419 83.4038 8.66057 84.4738 8.66057C85.3266 8.66057 86.071 8.82339 86.7067 9.14903C87.358 9.45917 87.8775 9.90111 88.2652 10.4749V3.75267H91.4053V20.5H88.6141L88.2652 18.895C88.0171 19.2362 87.7224 19.5541 87.3813 19.8487C87.0401 20.1278 86.6292 20.3527 86.1485 20.5233C85.6678 20.6938 85.1095 20.7791 84.4738 20.7791ZM85.1716 18.0344C85.7918 18.0344 86.3423 17.8949 86.823 17.6157C87.3037 17.3211 87.6759 16.9257 87.9395 16.4295C88.2031 15.9333 88.3349 15.3673 88.3349 14.7315C88.3349 14.0802 88.2031 13.5064 87.9395 13.0102C87.6759 12.4985 87.3037 12.1031 86.823 11.824C86.3423 11.5448 85.7918 11.4053 85.1716 11.4053C84.5668 11.4053 84.0241 11.5526 83.5433 11.8472C83.0626 12.1263 82.6827 12.514 82.4036 13.0102C82.14 13.5064 82.0082 14.0724 82.0082 14.7082C82.0082 15.3595 82.14 15.9333 82.4036 16.4295C82.6672 16.9257 83.0394 17.3211 83.5201 17.6157C84.0163 17.8949 84.5668 18.0344 85.1716 18.0344ZM94.528 20.5V8.93969H97.6681V20.5H94.528ZM96.0864 7.28822C95.5282 7.28822 95.063 7.11765 94.6908 6.7765C94.3341 6.43535 94.1558 6.01666 94.1558 5.52045C94.1558 4.99322 94.3341 4.56678 94.6908 4.24114C95.063 3.9155 95.5282 3.75267 96.0864 3.75267C96.6602 3.75267 97.1254 3.9155 97.482 4.24114C97.8542 4.56678 98.0403 4.99322 98.0403 5.52045C98.0403 6.01666 97.8542 6.43535 97.482 6.7765C97.1254 7.11765 96.6602 7.28822 96.0864 7.28822ZM106.006 20.5C105.184 20.5 104.463 20.3759 103.843 20.1278C103.238 19.8642 102.765 19.4378 102.424 18.8485C102.083 18.2438 101.912 17.4219 101.912 16.3829V11.5681H99.9351V8.93969H101.912L102.261 5.79957H105.052V8.93969H108.123V11.5681H105.052V16.4295C105.052 16.9567 105.169 17.3211 105.401 17.5227C105.634 17.7243 106.029 17.8251 106.587 17.8251H108.053V20.5H106.006Z"
                        class="fill-primary-500"></path>
                      <defs>
                        <clipPath id=":r4:">
                          <rect width="24" height="24" class="fill-primary-500" transform="translate(0.5 1)"></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <span class="absolute h-full w-10 sm:w-[60px] top-0 right-0 z-10 rotate-180 bg-[linear-gradient(90deg,_var(--theme-bg-default)_-8.54%,_transparent_100%)]"></span>
          </div>
        </div>
      </div>
    </section>
    <script src="../assets/js/plugins/tiny-slider.js"></script>
    <script type="module">
      document.addEventListener('DOMContentLoaded', function () {
        var slider = tns({
          container: '.clientele-slider3',
          items: 2,
          center:true,
          nav: false,
          speed: 500,
          gutter: 4,
          autoplayTimeout: 6000,
          slideBy: 1,
          loop: true,
          controls: false,
          autoplay: true,
          autoplayButtonOutput: false,
          autoplayButton: false,
          mouseDrag:true,
          responsive: {
            575: {
              items: 4,
              center:false,
            },
            992:{
              items: 5,
            }
          }
        });
      });
    </script>
    <!-- [ Clientele ] end -->
    <!-- [ Benefit ] start -->
    <section class="common-section">
      <div class="container">
        <div class="flex flex-col sm:flex-row gap-3 items-stretch">
          <div class="basis-full sm:basis-1/2">
            <div class="animate-y delay-reset rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col h-full">
              <div class="p-6 sm:p-8 md:p-10 flex flex-col items-start gap-8 sm:gap-10 h-full justify-between">
                <div class="relative flex items-center justify-center">
                  <i class="ti ti-cloud-up text-[26px] sm:text-4xl leading-none absolute z-10 text-primary-500"></i>
                  <!-- [ img starfab ] start -->
                  <svg class="w-[60px] h-[60px] sm:w-[70px] sm:h-[70px] lg:w-[80px] lg:h-[80px] stroke-[2.90909]" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M47.552 4.67508L45.6912 3.14787C43.5455 1.38675 40.4545 1.38675 38.3088 3.14787L36.448 4.67509C35.6785 5.30667 34.6395 5.50091 33.6937 5.18995L31.407 4.43804C28.7699 3.57097 25.8877 4.68757 24.523 7.10489L23.3396 9.20116C22.8502 10.0681 21.9515 10.6245 20.9573 10.6762L18.5533 10.8012C15.7812 10.9452 13.4969 13.0276 13.0976 15.7747L12.7514 18.1569C12.6082 19.1421 11.9712 19.9856 11.0628 20.3929L8.86631 21.3779C6.33339 22.5136 4.95561 25.2806 5.57567 27.9864L6.11338 30.3328C6.33575 31.3031 6.04647 32.3198 5.34657 33.0278L3.65418 34.7397C1.70259 36.7138 1.41739 39.7916 2.97302 42.0907L4.32203 44.0844C4.87993 44.9089 4.97746 45.9614 4.58057 46.8744L3.62087 49.0821C2.51418 51.6278 3.36008 54.6008 5.64117 56.1827L7.61931 57.5545C8.43737 58.1218 8.90854 59.068 8.86826 60.0627L8.77086 62.468C8.65855 65.2416 10.5213 67.7083 13.2198 68.3593L15.5599 68.9239C16.5276 69.1573 17.3088 69.8695 17.6306 70.8115L18.4086 73.0896C19.3059 75.7165 21.9339 77.3437 24.6853 76.9759L27.0713 76.657C28.0581 76.5251 29.0438 76.907 29.6841 77.6692L31.2326 79.5123C33.0181 81.6377 36.0565 82.2057 38.4893 80.8689L40.599 79.7096C41.4715 79.2301 42.5285 79.2301 43.401 79.7096L45.5107 80.8689C47.9435 82.2057 50.9818 81.6377 52.7674 79.5123L54.3159 77.6692C54.9562 76.907 55.9419 76.5251 56.9286 76.657L59.3147 76.9759C62.0661 77.3437 64.6941 75.7165 65.5914 73.0896L66.3694 70.8115C66.6912 69.8695 67.4724 69.1573 68.4401 68.9239L70.7802 68.3593C73.4787 67.7083 75.3414 65.2416 75.2291 62.468L75.1317 60.0627C75.0915 59.068 75.5626 58.1218 76.3807 57.5545L78.3588 56.1827C80.6399 54.6008 81.4858 51.6278 80.3791 49.0821L79.4194 46.8744C79.0225 45.9614 79.1201 44.9089 79.678 44.0844L81.027 42.0907C82.5826 39.7916 82.2974 36.7138 80.3458 34.7397L78.6534 33.0278C77.9535 32.3198 77.6642 31.3031 77.8866 30.3328L78.4243 27.9864C79.0444 25.2806 77.6666 22.5136 75.1337 21.3779L72.9372 20.3929C72.0288 19.9856 71.3918 19.1421 71.2486 18.1569L70.9024 15.7747C70.5031 13.0276 68.2188 10.9452 65.4467 10.8012L63.0427 10.6762C62.0485 10.6245 61.1498 10.0681 60.6604 9.20115L59.477 7.10489C58.1123 4.68757 55.2301 3.57097 52.593 4.43804L50.3062 5.18995C49.3605 5.50091 48.3215 5.30667 47.552 4.67508Z"
                      fill="url(#paint0_linear_5005_3474)"
                      stroke="url(#paint1_linear_5005_3474)"
                      stroke-width="2.90909"
                    />
                    <defs>
                      <linearGradient id="paint0_linear_5005_3474" x1="82" y1="42" x2="2" y2="42" gradientUnits="userSpaceOnUse">
                        <stop stop-color="var(--secondary-100)" />
                        <stop offset="1" stop-color="var(--neutral-100)" />
                      </linearGradient>
                      <linearGradient id="paint1_linear_5005_3474" x1="84.8571" y1="42.7143" x2="-3" y2="42.7143" gradientUnits="userSpaceOnUse">
                        <stop stop-color="var(--neutral-100)" />
                        <stop offset="1" stop-color="var(--secondary-100)" />
                      </linearGradient>
                    </defs>
                  </svg>
                </div>
                <div class="flex flex-col gap-2 sm:gap-3">
                  <h2>Data-Driven HR Solutions</h2>
                  <h6 class="text-theme-textsecondary">Track and monitor key performance indicators to measure the effectiveness.</h6>
                </div>
              </div>
            </div> 
          </div>
          <div class="basis-full sm:basis-1/2">
            <div class="animate-y p-4 lg:p-10 rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col h-full">
              <div class="flex flex-col">
                <div class="flex flex-row items-center py-3 sm:py-5 gap-2 lg:gap-3">
                  <div class="flex flex-col gap-2 w-full">
                    <h4 class="text-theme-text-secondary">Employee Turnover Rate</h4>
                    <div class="w-full bg-neutral-400 rounded-lg h-[6px]">
                      <div class="bg-primary-500 h-full rounded-lg" style="width: 15%"></div>
                    </div>
                  </div>
                  <div class="flex flex-row items-end">
                    <div class="h2">15</div>
                    <div class="h3 text-theme-text-secondary mb-0.5 md:mb-1">%</div>
                  </div>
                </div>
                <div class="flex flex-row items-center py-3 sm:py-5 gap-2 lg:gap-3">
                  <div class="flex flex-col gap-2 w-full">
                    <h4 class="text-theme-text-secondary">Average Time to Fill a Position</h4>
                    <div class="w-full bg-neutral-400 rounded-lg h-[6px]">
                      <div class="bg-primary-500 h-full rounded-lg" style="width: 30%"></div>
                    </div>
                  </div>
                  <div class="flex flex-row items-end">
                    <div class="h2">30</div>
                    <div class="h3 text-theme-text-secondary mb-0.5 md:mb-1">d</div>
                  </div>
                </div>
                <div class="flex flex-row items-center py-3 sm:py-5 gap-2 lg:gap-3">
                  <div class="flex flex-col gap-2 w-full">
                    <h4 class="text-theme-text-secondary">Absenteeism Rate</h4>
                    <div class="w-full bg-neutral-400 rounded-lg h-[6px]">
                      <div class="bg-primary-500 h-full rounded-lg" style="width: 80%"></div>
                    </div>
                  </div>
                  <div class="flex flex-row items-end">
                    <div class="h2">80</div>
                    <div class="h3 text-theme-text-secondary mb-0.5 md:mb-1">%</div>
                  </div>
                </div>
                <div class="flex flex-row items-center py-3 sm:py-5 gap-2 lg:gap-3">
                  <div class="flex flex-col gap-2 w-full">
                    <h4 class="text-theme-text-secondary">Compliance Adherence Rate</h4>
                    <div class="w-full bg-neutral-400 rounded-lg h-[6px]">
                      <div class="bg-primary-500 h-full rounded-lg" style="width: 95%"></div>
                    </div>
                  </div>
                  <div class="flex flex-row items-end">
                    <div class="h2">95</div>
                    <div class="h3 text-theme-text-secondary mb-0.5 md:mb-1">%</div>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </section>
    <!-- [ Benefit ] end -->

    <!-- [ Feature ] start -->
    <section class="common-section">
      <div class="container">
        <div class="flex flex-col gap-6 sm:gap-8">
          <div class="flex flex-col items-center justify-center gap-4 sm:gap-8">
            <div class="animate-y delay-reset flex flex-col gap-2 sm:gap-3 items-center text-center max-w-[340px] sm:max-w-[580px] lg:max-w-[615px] mx-auto">
              <h2>HR Analytics and Reporting</h2>
              <p class="h6 text-theme-textsecondary">
                Access real-time insights into your workforce with customizable reports and analytics.
              </p>
            </div>
            <div class="animate-y">
              <button class="btn btn-primary btn-md capitalize">
                Explore all Features
              </button>
            </div>
          </div>
          <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden">
            <div class="p-4 sm:p-6 lg:p-10">
              <div class="flex flex-col sm:flex-row gap-3">
                <div class="basis-full sm:basis-6/12 lg:basis-5/12">
                  <div class="flex flex-col gap-8 sm:gap-9 lg:gap-10">
                    <div class="flex flex-row items-start justify-end h-full gap-3 sm:gap-4">
                      <div class="w-[48px] h-[48px] sm:w-[60px] sm:h-[60px] bg-neutral-300 rounded-full flex items-center justify-center shrink-0">
                        <i class="ti ti-chart-histogram text-base sm:text-2xl leading-none text-primary-500"></i>
                      </div>
                      <div class="flex flex-col gap-1 sm:gap-2 grow">
                        <h4>Performance Management</h4>
                        <p class="body1 text-theme-textsecondary max-w-[350px]">Streamline performance evaluations, goal-setting, and feedback processes.</p>
                      </div>
                    </div>
                    <div class="flex flex-row items-start justify-end h-full gap-3 sm:gap-4">
                      <div class="w-[48px] h-[48px] sm:w-[60px] sm:h-[60px] bg-neutral-300 rounded-full flex items-center justify-center shrink-0">
                        <svg class="pc-icon w-6 h-6 text-primary-500 fill-primary-500 stroke-primary-500 stroke-2">
                          <use xlink:href="#custom-path"></use>
                        </svg>
                      </div>
                      <div class="flex flex-col gap-1 sm:gap-2 grow">
                        <h4>Recruitment and Applicant Tracking</h4>
                        <p class="body1 text-theme-textsecondary max-w-[350px]">Manage the entire recruitment lifecycle from job posting to candidate selection.</p>
                      </div>
                    </div>
                    <div class="flex flex-row items-start justify-end h-full gap-3 sm:gap-4">
                      <div class="w-[48px] h-[48px] sm:w-[60px] sm:h-[60px] bg-neutral-300 rounded-full flex items-center justify-center shrink-0">
                        <i class="ti ti-history text-base sm:text-2xl leading-none text-primary-500"></i>
                      </div>
                      <div class="flex flex-col gap-1 sm:gap-2 grow">
                        <h4>Time and Attendance Tracking</h4>
                        <p class="body1 text-theme-textsecondary max-w-[350px]">Easily track employee work hours, attendance, and overtime at many more things.</p>
                      </div>
                    </div>
                    <div class="flex flex-row items-start justify-end h-full gap-3 sm:gap-4">
                      <div class="w-[48px] h-[48px] sm:w-[60px] sm:h-[60px] bg-neutral-300 rounded-full flex items-center justify-center shrink-0">
                        <i class="ti ti-clipboard-text text-base sm:text-2xl leading-none text-primary-500"></i>
                      </div>
                      <div class="flex flex-col gap-1 sm:gap-2 grow">
                        <h4>HR Analytics and Reporting</h4>
                        <p class="body1 text-theme-textsecondary max-w-[350px]">Access real-time insights into your workforce with customizable reports and analytics.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="basis-full sm:basis-6/12 lg:basis-7/12">
                  <div class="h-[278px] sm:h-[470px] lg:h-[533px] w-full ltr:rounded-l-xl rtl:rounded-r-xl bg-center sm:bg-right bg-contain bg-no-repeat bg-[url('../images/graphics/hrm/graphics1-light.svg')] dark:bg-[url('../images/graphics/hrm/graphics1-dark.svg')]"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ Feature ] end -->
    <!-- [ Feature ] start -->
    <section class="common-section">
      <div class="container">
        <div class="flex flex-col gap-6 sm:gap-8">
          <div class="animate-y delay-reset flex flex-col items-center text-center gap-2 sm:gap-3">
            <h2>Empowering Businesses to Succeed</h2>
            <h6 class="text-theme-textsecondary max-w-[476px] md:max-w-[614px]">
              Learn how our HRM platform empowers businesses of all sizes to achieve their goals and reach new heights
            </h6>
          </div>
          <div class="flex flex-col-reverse sm:flex-row gap-3 items-stretch">
            <div class="basis-full sm:basis-1/2">
              <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col h-full">
                <div class="p-6 sm:p-8 md:p-10 flex flex-col items-start gap-6 sm:gap-8 md:gap-10 h-full justify-between">
                  <div class="flex flex-col gap-2 sm:gap-3">
                    <h4>Empower your business with our HRM platform, streamlining sales</h4>
                    <p class="body1 text-theme-textsecondary">Empower your business with our HRM platform, streamlining sales, marketing, and service processes to drive growth and build stronger customer relationships.</p>
                  </div>
                  <button class="btn btn-lg btn-primary">Try Predictive Cost Analytics</button>
                </div>
              </div> 
            </div>
            <div class="basis-full sm:basis-1/2">
              <div class="animate-y-down rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col items-center h-full min-h-[207px] sm:min-h-[368px] md:min-h-[336px] relative">
                <div class="-mb-2 lg:-mb-8 h-full min-h-[157px] sm:min-h-[241px] md:min-h-[372px] w-full scale-[1.12] origin-top bg-cover bg-top bg-no-repeat bg-[url('../images/graphics/hrm/graphics2-light.svg')] dark:bg-[url('../images/graphics/hrm/graphics2-dark.svg')]">
                  <div class="absolute inset-0 z-0 ltr:bg-[radial-gradient(71.13%_71.13%_at_50%_50.07%,_transparent_0%,_var(--neutral-100)_75%)] rtl:bg-[radial-gradient(71.13%_28.87%_at_50%_50.07%,_transparent_0%,_var(--neutral-100)_75%)]"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ Feature ] end -->

    <!-- [ process ] start -->
    <section class="common-section">
      <div class="container">
        <div class="flex flex-col gap-6 sm:gap-8">
          <div class="flex flex-col sm:flex-row gap-3">
            <div class="basis-full sm:basis-6/12">
              <div class="flex flex-col gap-5 justify-between h-full">
                <div class="animate-y delay-reset flex flex-col gap-2 sm:gap-3">
                  <h2>Effortless Onboarding</h2>
                  <h6 class="text-theme-textsecondary max-w-[750px]">
                    From job posting to candidate selection, our platform simplifies every step of the recruitment process.
                  </h6>
                </div>
                <div class="flex flex-col gap-3" id="accordionExample">
                  <div class="animate-y p-6 md:p-8 rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden show">
                    <a href="#" class="flex flex-row items-start gap-3 relative" data-pc-toggle="collapse" data-pc-target="#collapseOne1">
                      <span class="absolute inset-0"></span>
                      <div class="flex flex-col gap-2 sm:gap-3 grow">
                        <h4>Onboarding and Setup</h4>
                        <p class="body1 text-theme-textsecondary">Import employee data or add employees manually.</p>
                      </div>
                      <div>
                        <i class="ti ti-settings-up text-2xl sm:text-[40px] leading-none text-primary-500"></i>
                      </div>
                    </a>
                    <div id="collapseOne1" class="show" aria-labelledby="headingOne" data-pc-parent="#accordionExample">
                      <div class="w-[90%] sm:w-[90%] md:w-[80%] pt-3 md:pt-5">
                        <ul class="*:py-2">
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">Leverage the HRM's reporting and analytics tools to gain insights.</p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">
                                  Identify opportunities, analyze performance, and make data-driven decisions.
                                </p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">
                                  Take action based on the data to enhance relationships, sales, and business success.
                                </p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="animate-y p-6 md:p-8 rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden">
                    <a href="#" class="flex flex-row items-start gap-3 relative" data-pc-toggle="collapse" data-pc-target="#collapsetwo2">
                      <span class="absolute inset-0"></span>
                      <div class="flex flex-col gap-2 sm:gap-3 grow">
                        <h4>Usage and Implementation</h4>
                        <p class="body1 text-theme-textsecondary">Derive insights from data and implement strategic actions.</p>
                      </div>
                      <div>
                        <i class="ti ti-app-window text-2xl sm:text-[40px] leading-none text-primary-500"></i>
                      </div>
                    </a>
                    <div id="collapsetwo2" class="hidden" aria-labelledby="headingtwo" data-pc-parent="#accordionExample">
                      <div class="w-[90%] sm:w-[90%] md:w-[80%] pt-3 md:pt-5">
                        <ul class="*:py-2">
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">Analyze customer data to identify key trends and opportunities.</p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">
                                  Generate detailed reports that highlight performance metrics and areas for improvement.
                                </p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">
                                  Develop and implement strategies based on data-driven insights to drive growth.
                                </p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="animate-y p-6 md:p-8 rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden">
                    <a href="#" class="flex flex-row items-start gap-3 relative" data-pc-toggle="collapse" data-pc-target="#collapsethree3">
                      <span class="absolute inset-0"></span>
                      <div class="flex flex-col gap-2 sm:gap-3 grow">
                        <h4>Analysis and Optimization</h4>
                        <p class="body1 text-theme-textsecondary">Identify areas for improvement and implement</p>
                      </div>
                      <div>
                        <i class="ti ti-chart-histogram text-2xl sm:text-[40px] leading-none text-primary-500"></i>
                      </div>
                    </a>
                    <div id="collapsethree3" class="hidden" aria-labelledby="headingthree" data-pc-parent="#accordionExample">
                      <div class="w-[90%] sm:w-[90%] md:w-[80%] pt-3 md:pt-5">
                        <ul class="*:py-2">
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">Create personalized experiences that resonate with your customers.</p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">
                                  Leverage customer feedback to continuously improve engagement strategies.
                                </p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">
                                  Utilize HRM tools to manage customer interactions and track engagement levels.
                                </p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <svg
                                  class="pc-icon w-6 h-6 fill-primary-200 stroke-neutral-900 stroke-[2.5] sm:stroke-2 md:stroke-[1.5] shrink-0"
                                >
                                  <use xlink:href="#custom-check"></use>
                                </svg>
                              </div>
                              <div class="grow my-1">
                                <p class="body2 text-theme-textsecondary">
                                  Implement loyalty programs and rewards to foster long-term relationships.
                                </p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="basis-full sm:basis-6/12">
              <div class="animate-y-down rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col h-full">
                <div class="py-10 ltr:pl-10 rtl:pr-10 min-h-full h-[880px]">
                  <div
                    class="h-full border-[5px] border-neutral-200 ltr:border-r-0 rtl:border-l-0 ltr:rounded-l-xl rtl:rounded-r-xl bg-left-top bg-cover bg-[url('../images/graphics/hrm/desktop1-light.svg')] dark:bg-[url('../images/graphics/hrm/desktop1-dark.svg')]"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ process ] end -->

    <!-- [ Integration 1 ] start -->
    <section class="common-section">
      <div class="container">
        <div class="animate-y delay-reset bg-neutral-100 h-full rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
          <div class="relative overflow-hidden rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
            <div class="absolute inset-0 z-10 bg-[radial-gradient(51.92%_57.91%_at_50%_53.14%,_transparent_0%,_var(--neutral-100)_200%)]"></div>
            <div class="flex flex-row justify-center">
              <div class="rounded-full p-px bg-[linear-gradient(transparent_0%,_var(--theme-bg-default)_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/asana.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(transparent_0%,_var(--theme-bg-default)_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/slack.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(transparent_0%,_var(--theme-bg-default)_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/intercom.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(transparent_0%,_var(--theme-bg-default)_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/paypal.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(transparent_0%,_var(--theme-bg-default)_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/dropbox.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(transparent_0%,_var(--theme-bg-default)_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/jira.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(transparent_0%,_var(--theme-bg-default)_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/zoom.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
            </div>
            <div class="flex flex-row justify-center -mt-3 sm:-mt-3.5 lg:-mt-5">
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/skype.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/master-card.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/trip-advicer.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/google-drive.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/loom.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/mail-chimp.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/messenger-facebook.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
              <div class="rounded-full p-px bg-[linear-gradient(var(--theme-bg-default)_0%,_transparent_100%)]">
                <div class="bg-neutral-100 rounded-full w-[83px] sm:w-[105px] lg:w-[140px] h-[83px] sm:h-[105px] lg:h-[140px] flex items-center justify-center">
                  <img src="../assets/images/integration/notion.png" alt="image" class="w-6 sm:w-[30px] lg:w-10 h-6 sm:h-[30px] lg:h-10">
                </div>
              </div>
            </div>
          </div>
          <div class="bg-neutral-200 p-6 sm:p-8 md:p-10 h-full rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
            <div class="flex flex-col items-center justify-center gap-8">
              <div class="flex flex-col gap-2 sm:gap-3 text-center">
                <h2>Workflow Orchestrator Integration</h2>
                <p class="body1 text-theme-textsecondary max-w-[700px]">Integrate FlexFlow seamlessly as your workflow orchestrator. Elevate collaboration and automation with efficient integration solutions.</p>
              </div>
              <button class="btn btn-primary btn-lg">See All Integration</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ Integration 1 ] end -->
    <!-- [ Feature ] start -->
    <section class="common-section">
      <div class="container">
        <div class="flex flex-col gap-3">
          <div class="flex flex-col sm:flex-row gap-3">
            <div class="basis-full sm:basis-6/12">
              <div class="flex flex-col gap-5 justify-between h-full">
                <div class="animate-y delay-reset flex flex-col gap-2 sm:gap-3">
                  <h2>Data-Driven Decision Making</h2>
                  <h6 class="text-theme-textsecondary max-w-[750px]">
                    Your workforce with features designed to empower and connect employees.
                  </h6>
                </div>
                <div class="flex flex-row gap-3">
                  <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full basis-1/2">
                    <div class="p-3 sm:4 md:p-6 flex flex-col items-start h-full gap-9 sm:gap-8">
                      <div class="w-[60px] h-[60px] bg-neutral-300 rounded-full flex items-center justify-center">
                        <i class="ti ti-settings-up text-2xl leading-none text-primary-500"></i>
                      </div>
                      <div class="flex flex-col gap-2 sm:gap-3 grow">
                        <h4>Efficiency</h4>
                        <p class="body1 text-theme-textsecondary">Streamline HR processes, automate repetitive tasks, and save time.</p>
                      </div>
                    </div>
                  </div>
                  <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full basis-1/2">
                    <div class="p-3 sm:4 md:p-6 flex flex-col items-start h-full gap-9 sm:gap-8">
                      <div class="w-[60px] h-[60px] bg-neutral-300 rounded-full flex items-center justify-center">
                        <i class="ti ti-chart-histogram text-2xl leading-none text-primary-500"></i>
                      </div>
                      <div class="flex flex-col gap-2 sm:gap-3 grow">
                        <h4>Accuracy</h4>
                        <p class="body1 text-theme-textsecondary">Ensure data accuracy and minimize errors with centralized data management.</p>
                      </div>
                    </div>
                  </div>             
                </div>
              </div>
            </div>
            <div class="basis-full sm:basis-6/12">
              <div class="animate-y-down rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col h-full">
                <div class="p-6 sm:p-8 md:p-10 min-h-full h-[343px] sm:h-[445px] md:h-[530px]">
                  <div class="h-full ltr:rounded-l-xl rtl:rounded-r-xl bg-center bg-contain bg-no-repeat bg-[url('../images/graphics/hrm/graphics3-light.svg')] dark:bg-[url('../images/graphics/hrm/graphics3-dark.svg')]"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-col sm:flex-row gap-3">
            <div class="basis-full sm:basis-6/12">
              <div class="animate-y-down pt-14 rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col items-center gap-6 h-full">
                <div class="flex flex-col items-center gap-2">
                  <div class="flex flex-col items-center gap-1 dir">
                    <div class="flex -space-x-[14px] *:w-[42px] *:h-[42px] *:rounded-full *:border *:border-theme-bg-paper">
                      <img src="../assets/images/user/avatar1.png" alt="img" class="z-40">
                      <img src="../assets/images/user/avatar2.png" alt="img" class="z-30">
                      <img src="../assets/images/user/avatar3.png" alt="img" class="z-20">
                      <img src="../assets/images/user/avatar4.png" alt="img" class="z-10">
                      <img src="../assets/images/user/avatar5.png" alt="img" class="z-0">
                    </div>
                    <h6 class="subtitle2">10k+ Reviews (4.5 out of 5)</h6>
                  </div>
                  <div class="text-primary-500">
                    <!-- [ wawe image ] -->
                    <svg class="w-[92px] md:w-[122px] h-auto" viewBox="0 0 122 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        opacity="0.4"
                        d="M1.46484 6.83613L4.45387 3.7103C7.74598 0.267505 13.38 0.760513 16.0241 4.72277L16.5428 5.50001C19.2423 9.54539 25.1877 9.54539 27.8873 5.5V5.5C30.5869 1.45461 36.5322 1.45461 39.2318 5.5V5.5C41.9314 9.54539 47.8768 9.54539 50.5764 5.5V5.5C53.2759 1.45461 59.2213 1.45461 61.9209 5.5V5.5C64.6205 9.54539 70.5658 9.54539 73.2654 5.5V5.5C75.965 1.45461 81.9104 1.45461 84.61 5.5V5.5C87.3096 9.54539 93.2549 9.54539 95.9545 5.5V5.5C98.6541 1.45461 104.599 1.45461 107.299 5.5V5.5C109.999 9.54539 115.944 9.54539 118.644 5.5L120.534 2.66667"
                        stroke="currentColor"
                        strokeLinecap="round"
                      />
                    </svg>
                  </div>
                </div>
                <div class="h-[157px] sm:h-[241px] md:h-[352px] w-full scale-[1.3] origin-top bg-cover bg-center bg-no-repeat bg-[url('../images/graphics/hrm/graphics2-light.svg')] dark:bg-[url('../images/graphics/hrm/graphics2-dark.svg')] relative">
                  <div class="absolute inset-0 bg-[radial-gradient(71.13%_71.13%_at_50%_50.07%,_rgba(241,_244,_249,_0)_0%,_rgb(241,_244,_249)_100%)] dark:bg-[radial-gradient(71.13%_71.13%_at_50%_50.07%,_rgba(26,_28,_30,_0)_0%,_rgb(26,_28,_30)_100%)]"></div>
                </div>
              </div>
            </div>
            <div class="basis-full sm:basis-6/12">
              <div class="flex flex-col gap-3 justify-between h-full">
                <div class="flex flex-row gap-3">
                  <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full basis-1/2">
                    <div class="p-3 sm:4 md:p-6 flex flex-col items-start h-full gap-9 sm:gap-8">
                      <div class="w-[60px] h-[60px] bg-neutral-300 rounded-full flex items-center justify-center">
                        <i class="ti ti-clipboard-text text-2xl leading-none text-primary-500"></i>
                      </div>
                      <div class="flex flex-col gap-2 sm:gap-3 grow">
                        <h4>Compliance</h4>
                        <p class="body1 text-theme-textsecondary">Stay compliant with labor laws and regulations through automated compliance.</p>
                      </div>
                    </div>
                  </div>
                  <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full basis-1/2">
                    <div class="p-3 sm:4 md:p-6 flex flex-col items-start h-full gap-9 sm:gap-8">
                      <div class="w-[60px] h-[60px] bg-neutral-300 rounded-full flex items-center justify-center">
                        <i class="ti ti-coin text-2xl leading-none text-primary-500"></i>
                      </div>
                      <div class="flex flex-col gap-2 sm:gap-3 grow">
                        <h4>Cost Savings</h4>
                        <p class="body1 text-theme-textsecondary">Reduce administrative costs and increase operational efficiency.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden">
                  <div class="p-4 sm:p-8 flex flex-col items-start h-full gap-8 sm:gap-14">
                    <h6 class="text-theme-textsecondary max-w-[530px]">Promote employee development and career growth through training and performance management features.</h6>
                    <button class="btn btn-primary btn-md capitalize">
                      <span class="flex items-center gap-2 ltr:-ml-1 rtl:-mr-1">
                        <i class="ti ti-sparkles text-base leading-none"></i>
                        Explore all Features
                      </span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ Feature ] end -->
    <link rel="stylesheet" href="../assets/css/plugins/tiny-slider.css" />
    <!-- [ Testimonial ] start -->
    <section class="common-section">
      <div class="flex flex-col gap-6 sm:gap-8 overflow-hidden">
        <div class="container">
          <div class="animate-y delay-reset flex flex-col items-center text-center gap-2 sm:gap-3">
            <h2>Why Our Clients Love Us</h2>
            <h6 class="text-theme-textsecondary">Hear directly from our clients about why they choose and recommend our HRM solutions.</h6>
          </div>
        </div>
        <div class="overflow-hidden animate-y delay-reset">
          <div class="flex flex-col gap-6 sm:gap-8" dir="ltr">
            <div class="testimonial-5-slider flex items-stretch">
              <div class="item group">
                <div class="bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px] overflow-hidden h-full">
                  <div class="flex flex-col h-full justify-between">
                    <div class="flex flex-col gap-3 p-6 lg:p-10 items-center text-center">
                      <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px] opacity-30" viewBox="0 0 136 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M19.9316 5.3949C19.9316 3.57484 22.1451 2.67781 23.4122 3.98435L35.0876 16.0232C35.8566 16.816 36.2866 17.8771 36.2866 18.9816V32.9165C36.2866 34.7365 34.0732 35.6335 32.8061 34.327L21.1306 22.2882C20.3617 21.4953 19.9316 20.4342 19.9316 19.3297V5.3949Z"
                          class="fill-primary-100" />
                        <path
                          d="M9.79688 4.99939C9.79688 3.17933 12.0103 2.2823 13.2774 3.58884L24.7806 15.45C25.66 16.3568 26.1518 17.5704 26.1518 18.8336V32.521C26.1518 34.341 23.9384 35.238 22.6713 33.9315L10.9958 21.8927C10.2269 21.0998 9.79688 20.0387 9.79688 18.9342V4.99939Z"
                          class="fill-primary-500" />
                        <path
                          d="M0 5.3949C0 3.57484 2.21342 2.67781 3.48052 3.98435L15.156 16.0232C15.9249 16.816 16.3549 17.8771 16.3549 18.9816V32.9165C16.3549 34.7365 14.1415 35.6335 12.8744 34.327L1.19896 22.2882C0.430024 21.4953 0 20.4342 0 19.3297V5.3949Z"
                          class="fill-primary-500" />
                        <path
                          d="M51.6602 26.458V12.5717H46.9151V10.1759H59.4058V12.5717H54.6375V26.458H51.6602ZM65.0575 26.7371C63.8945 26.7371 62.8633 26.489 61.9639 25.9928C61.0645 25.4966 60.359 24.7988 59.8472 23.8994C59.3355 23 59.0797 21.961 59.0797 20.7825C59.0797 19.5885 59.3278 18.5263 59.824 17.5959C60.3357 16.6655 61.0335 15.9444 61.9174 15.4327C62.8168 14.9055 63.8713 14.6418 65.0808 14.6418C66.2128 14.6418 67.213 14.8899 68.0813 15.3862C68.9497 15.8824 69.6243 16.5647 70.105 17.4331C70.6012 18.2859 70.8493 19.2396 70.8493 20.2941C70.8493 20.4646 70.8416 20.643 70.826 20.829C70.826 21.0151 70.8183 21.209 70.8028 21.4105H62.0337C62.0957 22.3099 62.4059 23.0155 62.9641 23.5272C63.5379 24.0389 64.2279 24.2948 65.0343 24.2948C65.639 24.2948 66.143 24.163 66.5462 23.8994C66.9649 23.6203 67.275 23.2636 67.4766 22.8294H70.5004C70.2833 23.5582 69.9189 24.225 69.4072 24.8298C68.911 25.4191 68.2907 25.8843 67.5464 26.2254C66.8175 26.5666 65.9879 26.7371 65.0575 26.7371ZM65.0808 17.0609C64.352 17.0609 63.7084 17.2702 63.1502 17.6889C62.5919 18.0921 62.2353 18.7124 62.0802 19.5497H67.8255C67.779 18.7899 67.4998 18.1851 66.9881 17.7354C66.4764 17.2857 65.8406 17.0609 65.0808 17.0609ZM79.0056 26.7371C77.8271 26.7371 76.7882 26.4813 75.8888 25.9695C74.9894 25.4578 74.2761 24.7445 73.7488 23.8296C73.2371 22.9147 72.9812 21.868 72.9812 20.6895C72.9812 19.511 73.2371 18.4643 73.7488 17.5494C74.2761 16.6345 74.9894 15.9211 75.8888 15.4094C76.7882 14.8977 77.8271 14.6418 79.0056 14.6418C80.4788 14.6418 81.7193 15.0295 82.7273 15.8048C83.7352 16.5647 84.3787 17.6191 84.6579 18.9682H81.5177C81.3627 18.41 81.0525 17.9758 80.5873 17.6657C80.1376 17.34 79.6026 17.1772 78.9824 17.1772C78.1605 17.1772 77.4627 17.4873 76.889 18.1076C76.3152 18.7279 76.0283 19.5885 76.0283 20.6895C76.0283 21.7905 76.3152 22.6511 76.889 23.2714C77.4627 23.8916 78.1605 24.2018 78.9824 24.2018C79.6026 24.2018 80.1376 24.0467 80.5873 23.7366C81.0525 23.4264 81.3627 22.9845 81.5177 22.4107H84.6579C84.3787 23.7133 83.7352 24.76 82.7273 25.5509C81.7193 26.3417 80.4788 26.7371 79.0056 26.7371ZM87.3004 26.458V9.71068H90.2777V16.6887C90.6654 16.053 91.1849 15.5567 91.8362 15.2001C92.503 14.8279 93.2628 14.6418 94.1157 14.6418C95.5423 14.6418 96.6433 15.0915 97.4186 15.9909C98.2094 16.8903 98.6049 18.2084 98.6049 19.9452V26.458H95.6508V20.2243C95.6508 19.2318 95.4492 18.472 95.0461 17.9448C94.6584 17.4176 94.0381 17.1539 93.1853 17.1539C92.3479 17.1539 91.6501 17.4486 91.0918 18.0378C90.5491 18.6271 90.2777 19.4489 90.2777 20.5034V26.458H87.3004ZM101.452 26.458V9.71068H104.429V26.458H101.452ZM109.076 13.1299C108.534 13.1299 108.084 12.9671 107.727 12.6415C107.386 12.3158 107.215 11.9049 107.215 11.4087C107.215 10.9125 107.386 10.5093 107.727 10.1991C108.084 9.8735 108.534 9.71068 109.076 9.71068C109.619 9.71068 110.061 9.8735 110.402 10.1991C110.759 10.5093 110.937 10.9125 110.937 11.4087C110.937 11.9049 110.759 12.3158 110.402 12.6415C110.061 12.9671 109.619 13.1299 109.076 13.1299ZM107.588 26.458V14.921H110.565V26.458H107.588ZM114.208 26.458V17.4098H112.626V14.921H114.208V13.5719C114.208 12.1763 114.556 11.1838 115.254 10.5946C115.968 10.0053 116.929 9.71068 118.139 9.71068H119.418V12.246H118.604C118.092 12.246 117.728 12.3468 117.51 12.5484C117.293 12.75 117.185 13.0912 117.185 13.5719V14.921H119.674V17.4098H117.185V26.458H114.208ZM123.474 31.5752L126.149 25.6904H125.451L120.962 14.921H124.195L127.428 23.0388L130.801 14.921H133.964L126.637 31.5752H123.474Z"
                          class="fill-primary-500" />
                      </svg>
                      <h3 class="before:content-[open-quote] after:content-[close-quote]">
                        This AI platform has revolutionized my workflow. Fast, accurate, and indispensable!
                      </h3>
                    </div>
                    <div class="p-4 sm:p-6 flex flex-row gap-2 sm:gap-3 bg-neutral-200 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                      <div class="flex flex-col gap-3 justify-center items-center w-full text-center">
                        <img src="../assets/images/user/avatar2.png" alt="images" class="w-[60px] h-[60px] rounded-full" />
                        <div class="flex gap-1 flex-col justify-center">
                          <h5>Anne Thompson</h5>
                          <div class="body2 text-theme-text-secondary">Direct Optimization Executive</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item group">
                <div class="bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px] overflow-hidden h-full">
                  <div class="flex flex-col h-full justify-between">
                    <div class="flex flex-col gap-3 p-6 lg:p-10 items-center text-center">
                      <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px] opacity-30" viewBox="0 0 132 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M34.068 20V3.71788H37.6036L42.7906 14.0454L47.9078 3.71788H51.4434V20H48.4661V8.76534L43.9303 17.674H41.5811L37.0453 8.76534V20H34.068ZM58.5101 20.2791C57.5177 20.2791 56.7036 20.1241 56.0678 19.8139C55.432 19.4883 54.959 19.0618 54.6489 18.5346C54.3388 18.0074 54.1837 17.4259 54.1837 16.7901C54.1837 15.7201 54.6024 14.8517 55.4398 14.185C56.2771 13.5182 57.5332 13.1848 59.2079 13.1848H62.1387V12.9056C62.1387 12.1148 61.9138 11.5333 61.4641 11.1611C61.0144 10.789 60.4562 10.6029 59.7894 10.6029C59.1846 10.6029 58.6574 10.7502 58.2077 11.0448C57.758 11.324 57.4789 11.7426 57.3704 12.3009H54.4628C54.5404 11.4635 54.8195 10.7347 55.3002 10.1144C55.7964 9.49415 56.4322 9.0212 57.2075 8.69555C57.9829 8.35441 58.8513 8.18383 59.8127 8.18383C61.4564 8.18383 62.7512 8.59476 63.6971 9.41662C64.643 10.2385 65.116 11.4015 65.116 12.9056V20H62.5806L62.3015 18.1392C61.9604 18.7595 61.4797 19.2712 60.8594 19.6744C60.2546 20.0775 59.4715 20.2791 58.5101 20.2791ZM59.1846 17.9531C60.0375 17.9531 60.6966 17.674 61.1618 17.1157C61.6425 16.5575 61.9449 15.8674 62.0689 15.0456H59.5335C58.7427 15.0456 58.1767 15.1929 57.8356 15.4875C57.4944 15.7666 57.3238 16.1156 57.3238 16.5342C57.3238 16.9839 57.4944 17.3328 57.8356 17.5809C58.1767 17.8291 58.6264 17.9531 59.1846 17.9531ZM67.9572 20V8.46295H70.6088L70.888 10.6261C71.3067 9.88182 71.8726 9.29257 72.586 8.85838C73.3148 8.40868 74.1677 8.18383 75.1446 8.18383V11.324H74.3072C73.6559 11.324 73.0744 11.4247 72.5627 11.6263C72.051 11.8279 71.6478 12.1768 71.3532 12.673C71.074 13.1693 70.9345 13.8593 70.9345 14.7432V20H67.9572ZM77.1795 20V3.25267H80.1568V13.1382L84.2506 8.46295H87.7861L83.0643 13.7198L88.5537 20H84.8321L80.1568 14.2082V20H77.1795ZM95.0513 20.2791C93.8883 20.2791 92.8571 20.031 91.9577 19.5348C91.0583 19.0386 90.3527 18.3408 89.841 17.4414C89.3293 16.542 89.0734 15.503 89.0734 14.3245C89.0734 13.1305 89.3215 12.0683 89.8178 11.1379C90.3295 10.2075 91.0273 9.4864 91.9112 8.97468C92.8106 8.44745 93.865 8.18383 95.0746 8.18383C96.2065 8.18383 97.2067 8.43194 98.0751 8.92816C98.9435 9.42437 99.618 10.1067 100.099 10.9751C100.595 11.8279 100.843 12.7816 100.843 13.8361C100.843 14.0066 100.835 14.185 100.82 14.371C100.82 14.5571 100.812 14.751 100.797 14.9525H92.0275C92.0895 15.8519 92.3996 16.5575 92.9579 17.0692C93.5316 17.5809 94.2217 17.8368 95.028 17.8368C95.6328 17.8368 96.1368 17.705 96.5399 17.4414C96.9586 17.1623 97.2688 16.8056 97.4703 16.3714H100.494C100.277 17.1002 99.9127 17.767 99.4009 18.3718C98.9047 18.961 98.2845 19.4262 97.5401 19.7674C96.8113 20.1085 95.9817 20.2791 95.0513 20.2791ZM95.0746 10.6029C94.3457 10.6029 93.7022 10.8122 93.144 11.2309C92.5857 11.6341 92.2291 12.2544 92.074 13.0917H97.8193C97.7727 12.3319 97.4936 11.7271 96.9819 11.2774C96.4702 10.8277 95.8344 10.6029 95.0746 10.6029ZM108.283 20C107.074 20 106.105 19.7054 105.376 19.1161C104.647 18.5269 104.282 17.4801 104.282 15.976V10.9518H102.305V8.46295H104.282L104.631 5.36935H107.26V8.46295H110.377V10.9518H107.26V15.9992C107.26 16.5575 107.376 16.9452 107.609 17.1623C107.857 17.3638 108.275 17.4646 108.865 17.4646H110.307V20H108.283ZM112.933 20V3.25267H115.91V20H112.933ZM120.395 25.1172L123.069 19.2324H122.372L117.882 8.46295H121.116L124.349 16.5808L127.721 8.46295H130.885L123.558 25.1172H120.395Z"
                          class="fill-primary-500" />
                        <rect x="0.845703" y="14.8545" width="5.91373" height="9.19306" rx="2.95687" class="fill-primary-500" />
                        <rect x="0.845703" y="0.783203" width="5.91373" height="5.91373" rx="2.95687" class="fill-primary-500" />
                        <rect x="9.44922" y="7.62695" width="5.91373" height="16.4206" rx="2.95687" class="fill-primary-500" />
                        <rect x="18.0547" y="0.783203" width="5.91373" height="23.2642" rx="2.95687" class="fill-primary-100" />
                      </svg>
                      <h3 class="before:content-[open-quote] after:content-[close-quote]">
                        The user interface is intuitive, making it easy for our team to adapt and maximize productivity.
                      </h3>
                    </div>
                    <div class="p-4 sm:p-6 flex flex-row gap-2 sm:gap-3 bg-neutral-200 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                      <div class="flex flex-col gap-3 justify-center items-center w-full text-center">
                        <img src="../assets/images/user/avatar4.png" alt="images" class="w-[60px] h-[60px] rounded-full" />
                        <div class="flex gap-1 flex-col justify-center">
                          <h5>Maria</h5>
                          <div class="body2 text-theme-text-secondary">Business Analyst</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item group">
                <div class="bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px] overflow-hidden h-full">
                  <div class="flex flex-col h-full justify-between">
                    <div class="flex flex-col gap-3 p-6 lg:p-10 items-center text-center">
                      <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px] opacity-30" viewBox="0 0 115 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M36.4411 20V3.71788H42.4189C43.7215 3.71788 44.7915 3.94273 45.6288 4.39242C46.4817 4.82661 47.1175 5.42362 47.5362 6.18346C47.9549 6.92778 48.1642 7.75739 48.1642 8.67229C48.1642 9.66473 47.9006 10.5719 47.3733 11.3937C46.8616 12.2156 46.0553 12.8126 44.9543 13.1848L48.327 20H44.9078L41.8839 13.5802H39.4184V20H36.4411ZM39.4184 11.3937H42.2329C43.2253 11.3937 43.9541 11.1534 44.4193 10.6727C44.8845 10.192 45.1171 9.55618 45.1171 8.76534C45.1171 7.99 44.8845 7.36972 44.4193 6.90452C43.9696 6.43932 43.233 6.20672 42.2096 6.20672H39.4184V11.3937ZM55.765 20.2791C54.602 20.2791 53.5708 20.031 52.6714 19.5348C51.772 19.0386 51.0664 18.3408 50.5547 17.4414C50.043 16.542 49.7871 15.503 49.7871 14.3245C49.7871 13.1305 50.0352 12.0683 50.5315 11.1379C51.0432 10.2075 51.741 9.4864 52.6249 8.97468C53.5243 8.44745 54.5787 8.18383 55.7883 8.18383C56.9203 8.18383 57.9204 8.43194 58.7888 8.92816C59.6572 9.42437 60.3317 10.1067 60.8125 10.9751C61.3087 11.8279 61.5568 12.7816 61.5568 13.8361C61.5568 14.0066 61.549 14.185 61.5335 14.371C61.5335 14.5571 61.5258 14.751 61.5103 14.9525H52.7412C52.8032 15.8519 53.1133 16.5575 53.6716 17.0692C54.2453 17.5809 54.9354 17.8368 55.7417 17.8368C56.3465 17.8368 56.8505 17.705 57.2537 17.4414C57.6723 17.1623 57.9825 16.8056 58.1841 16.3714H61.2079C60.9908 17.1002 60.6264 17.767 60.1147 18.3718C59.6184 18.961 58.9982 19.4262 58.2538 19.7674C57.525 20.1085 56.6954 20.2791 55.765 20.2791ZM55.7883 10.6029C55.0594 10.6029 54.4159 10.8122 53.8577 11.2309C53.2994 11.6341 52.9428 12.2544 52.7877 13.0917H58.533C58.4864 12.3319 58.2073 11.7271 57.6956 11.2774C57.1839 10.8277 56.5481 10.6029 55.7883 10.6029ZM68.0384 20.2791C67.0459 20.2791 66.2318 20.1241 65.5961 19.8139C64.9603 19.4883 64.4873 19.0618 64.1772 18.5346C63.8671 18.0074 63.712 17.4259 63.712 16.7901C63.712 15.7201 64.1307 14.8517 64.968 14.185C65.8054 13.5182 67.0615 13.1848 68.7362 13.1848H71.667V12.9056C71.667 12.1148 71.4421 11.5333 70.9924 11.1611C70.5427 10.789 69.9845 10.6029 69.3177 10.6029C68.7129 10.6029 68.1857 10.7502 67.736 11.0448C67.2863 11.324 67.0072 11.7426 66.8986 12.3009H63.9911C64.0686 11.4635 64.3478 10.7347 64.8285 10.1144C65.3247 9.49415 65.9605 9.0212 66.7358 8.69555C67.5111 8.35441 68.3795 8.18383 69.3409 8.18383C70.9847 8.18383 72.2795 8.59476 73.2254 9.41662C74.1713 10.2385 74.6443 11.4015 74.6443 12.9056V20H72.1089L71.8298 18.1392C71.4886 18.7595 71.0079 19.2712 70.3877 19.6744C69.7829 20.0775 68.9998 20.2791 68.0384 20.2791ZM68.7129 17.9531C69.5658 17.9531 70.2248 17.674 70.69 17.1157C71.1707 16.5575 71.4731 15.8674 71.5972 15.0456H69.0618C68.271 15.0456 67.705 15.1929 67.3638 15.4875C67.0227 15.7666 66.8521 16.1156 66.8521 16.5342C66.8521 16.9839 67.0227 17.3328 67.3638 17.5809C67.705 17.8291 68.1547 17.9531 68.7129 17.9531ZM77.4855 20V3.25267H80.4628V20H77.4855ZM88.6454 20C87.4359 20 86.4667 19.7054 85.7379 19.1161C85.0091 18.5269 84.6447 17.4801 84.6447 15.976V10.9518H82.6676V8.46295H84.6447L84.9936 5.36935H87.622V8.46295H90.7389V10.9518H87.622V15.9992C87.622 16.5575 87.7383 16.9452 87.9709 17.1623C88.219 17.3638 88.6377 17.4646 89.2269 17.4646H90.6691V20H88.6454ZM98.5357 20.2791C97.4192 20.2791 96.4113 20.0233 95.5119 19.5115C94.628 18.9998 93.9225 18.2943 93.3952 17.3949C92.8835 16.48 92.6277 15.4255 92.6277 14.2315C92.6277 13.0375 92.8913 11.9907 93.4185 11.0914C93.9457 10.1765 94.6513 9.46314 95.5352 8.95142C96.4346 8.43969 97.4425 8.18383 98.559 8.18383C99.66 8.18383 100.652 8.43969 101.536 8.95142C102.436 9.46314 103.141 10.1765 103.653 11.0914C104.18 11.9907 104.444 13.0375 104.444 14.2315C104.444 15.4255 104.18 16.48 103.653 17.3949C103.141 18.2943 102.436 18.9998 101.536 19.5115C100.637 20.0233 99.6367 20.2791 98.5357 20.2791ZM98.5357 17.6972C99.3111 17.6972 99.9856 17.4104 100.559 16.8366C101.133 16.2474 101.42 15.379 101.42 14.2315C101.42 13.084 101.133 12.2233 100.559 11.6496C99.9856 11.0603 99.3188 10.7657 98.559 10.7657C97.7682 10.7657 97.0859 11.0603 96.5121 11.6496C95.9539 12.2233 95.6747 13.084 95.6747 14.2315C95.6747 15.379 95.9539 16.2474 96.5121 16.8366C97.0859 17.4104 97.7604 17.6972 98.5357 17.6972ZM107.106 20V8.46295H109.757L110.037 10.6261C110.455 9.88182 111.021 9.29257 111.735 8.85838C112.463 8.40868 113.316 8.18383 114.293 8.18383V11.324H113.456C112.805 11.324 112.223 11.4247 111.711 11.6263C111.2 11.8279 110.796 12.1768 110.502 12.673C110.223 13.1693 110.083 13.8593 110.083 14.7432V20H107.106Z"
                          class="fill-primary-500"
                        />
                        <path
                          d="M0.929688 1.80261C0.929688 1.0832 1.51288 0.5 2.23229 0.5H6.62708C7.34649 0.5 7.92969 1.0832 7.92969 1.80261V15.5H0.929688V1.80261Z"
                          class="fill-primary-100"
                        />
                        <path
                          d="M1.2219 26.3364H23.6777C24.0839 26.3364 24.4132 26.0071 24.4132 25.6008V12.2911C24.4132 12.0734 24.3169 11.867 24.1501 11.7272L12.9222 2.31965C12.6489 2.09065 12.2507 2.09065 11.9774 2.31965L0.749488 11.7272C0.582685 11.867 0.486328 12.0734 0.486328 12.2911V25.6008C0.486328 26.0071 0.815656 26.3364 1.2219 26.3364Z"
                          class="fill-primary-500"
                        />
                      </svg>
                      <h3 class="before:content-[open-quote] after:content-[close-quote]">
                        Our sales have increased by 30% since we started using this HRM. It’s an invaluable tool for our business.
                      </h3>
                    </div>
                    <div class="p-4 sm:p-6 flex flex-row gap-2 sm:gap-3 bg-neutral-200 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                      <div class="flex flex-col gap-3 justify-center items-center w-full text-center">
                        <img src="../assets/images/user/avatar3.png" alt="images" class="w-[60px] h-[60px] rounded-full" />
                        <div class="flex gap-1 flex-col justify-center">
                          <h5>Jeffrey Rath</h5>
                          <div class="body2 text-theme-text-secondary">SEO</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item group">
                <div class="bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px] overflow-hidden h-full">
                  <div class="flex flex-col h-full justify-between">
                    <div class="flex flex-col gap-3 p-6 lg:p-10 items-center text-center">
                      <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px] opacity-30" viewBox="0 0 146 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M38.4274 20.3887V4.10655H48.941V6.50235H41.4047V11.0613H47.4989V13.4106H41.4047V20.3887H38.4274ZM52.7738 7.06059C52.2311 7.06059 51.7814 6.89777 51.4247 6.57213C51.0836 6.24649 50.913 5.83556 50.913 5.33934C50.913 4.84312 51.0836 4.43995 51.4247 4.12981C51.7814 3.80417 52.2311 3.64135 52.7738 3.64135C53.3166 3.64135 53.7585 3.80417 54.0997 4.12981C54.4563 4.43995 54.6346 4.84312 54.6346 5.33934C54.6346 5.83556 54.4563 6.24649 54.0997 6.57213C53.7585 6.89777 53.3166 7.06059 52.7738 7.06059ZM51.2852 20.3887V8.85163H54.2625V20.3887H51.2852ZM57.3701 20.3887V8.85163H59.9985L60.2311 10.8055C60.5877 10.1232 61.0995 9.58044 61.7663 9.17727C62.4486 8.77409 63.2472 8.5725 64.1621 8.5725C65.5887 8.5725 66.6974 9.0222 67.4883 9.92159C68.2791 10.821 68.6745 12.1391 68.6745 13.8758V20.3887H65.6972V14.1549C65.6972 13.1625 65.4956 12.4027 65.0925 11.8754C64.6893 11.3482 64.0613 11.0846 63.2084 11.0846C62.371 11.0846 61.681 11.3792 61.1382 11.9685C60.611 12.5577 60.3474 13.3796 60.3474 14.4341V20.3887H57.3701ZM75.499 20.6678C74.5066 20.6678 73.6925 20.5127 73.0567 20.2026C72.4209 19.8769 71.948 19.4505 71.6378 18.9233C71.3277 18.3961 71.1726 17.8145 71.1726 17.1788C71.1726 16.1088 71.5913 15.2404 72.4287 14.5736C73.266 13.9068 74.5221 13.5734 76.1968 13.5734H79.1276V13.2943C79.1276 12.5035 78.9028 11.922 78.4531 11.5498C78.0034 11.1776 77.4451 10.9916 76.7783 10.9916C76.1736 10.9916 75.6463 11.1389 75.1966 11.4335C74.7469 11.7126 74.4678 12.1313 74.3593 12.6896H71.4518C71.5293 11.8522 71.8084 11.1234 72.2891 10.5031C72.7853 9.88283 73.4211 9.40987 74.1965 9.08423C74.9718 8.74308 75.8402 8.5725 76.8016 8.5725C78.4453 8.5725 79.7401 8.98343 80.686 9.80529C81.632 10.6272 82.1049 11.7902 82.1049 13.2943V20.3887H79.5696L79.2904 18.5279C78.9493 19.1481 78.4686 19.6599 77.8483 20.063C77.2435 20.4662 76.4604 20.6678 75.499 20.6678ZM76.1736 18.3418C77.0264 18.3418 77.6855 18.0627 78.1507 17.5044C78.6314 16.9462 78.9338 16.2561 79.0578 15.4343H76.5225C75.7316 15.4343 75.1656 15.5816 74.8245 15.8762C74.4833 16.1553 74.3128 16.5042 74.3128 16.9229C74.3128 17.3726 74.4833 17.7215 74.8245 17.9696C75.1656 18.2177 75.6153 18.3418 76.1736 18.3418ZM84.9461 20.3887V8.85163H87.5745L87.8071 10.8055C88.1638 10.1232 88.6755 9.58044 89.3423 9.17727C90.0246 8.77409 90.8232 8.5725 91.7381 8.5725C93.1647 8.5725 94.2734 9.0222 95.0643 9.92159C95.8551 10.821 96.2506 12.1391 96.2506 13.8758V20.3887H93.2733V14.1549C93.2733 13.1625 93.0717 12.4027 92.6685 11.8754C92.2653 11.3482 91.6373 11.0846 90.7844 11.0846C89.947 11.0846 89.257 11.3792 88.7143 11.9685C88.187 12.5577 87.9234 13.3796 87.9234 14.4341V20.3887H84.9461ZM104.75 20.6678C103.571 20.6678 102.532 20.4119 101.633 19.9002C100.734 19.3885 100.02 18.6752 99.493 17.7603C98.9813 16.8454 98.7254 15.7987 98.7254 14.6201C98.7254 13.4416 98.9813 12.3949 99.493 11.48C100.02 10.5651 100.734 9.85181 101.633 9.34009C102.532 8.82837 103.571 8.5725 104.75 8.5725C106.223 8.5725 107.463 8.96017 108.471 9.73551C109.479 10.4953 110.123 11.5498 110.402 12.8989H107.262C107.107 12.3407 106.797 11.9065 106.331 11.5963C105.882 11.2707 105.347 11.1079 104.727 11.1079C103.905 11.1079 103.207 11.418 102.633 12.0383C102.059 12.6585 101.772 13.5192 101.772 14.6201C101.772 15.7211 102.059 16.5818 102.633 17.202C103.207 17.8223 103.905 18.1324 104.727 18.1324C105.347 18.1324 105.882 17.9774 106.331 17.6672C106.797 17.3571 107.107 16.9152 107.262 16.3414H110.402C110.123 17.644 109.479 18.6907 108.471 19.4815C107.463 20.2724 106.223 20.6678 104.75 20.6678ZM118.65 20.6678C117.487 20.6678 116.456 20.4197 115.557 19.9235C114.657 19.4273 113.952 18.7294 113.44 17.8301C112.928 16.9307 112.672 15.8917 112.672 14.7132C112.672 13.5192 112.921 12.457 113.417 11.5265C113.928 10.5961 114.626 9.87507 115.51 9.36335C116.41 8.83612 117.464 8.5725 118.674 8.5725C119.806 8.5725 120.806 8.82061 121.674 9.31683C122.542 9.81305 123.217 10.4953 123.698 11.3637C124.194 12.2166 124.442 13.1703 124.442 14.2247C124.442 14.3953 124.434 14.5736 124.419 14.7597C124.419 14.9458 124.411 15.1396 124.396 15.3412H115.626C115.688 16.2406 115.999 16.9462 116.557 17.4579C117.131 17.9696 117.821 18.2255 118.627 18.2255C119.232 18.2255 119.736 18.0937 120.139 17.8301C120.558 17.5509 120.868 17.1943 121.069 16.7601H124.093C123.876 17.4889 123.512 18.1557 123 18.7605C122.504 19.3497 121.883 19.8149 121.139 20.1561C120.41 20.4972 119.581 20.6678 118.65 20.6678ZM118.674 10.9916C117.945 10.9916 117.301 11.2009 116.743 11.6196C116.185 12.0228 115.828 12.643 115.673 13.4804H121.418C121.372 12.7206 121.093 12.1158 120.581 11.6661C120.069 11.2164 119.433 10.9916 118.674 10.9916ZM126.946 20.3887V3.64135H129.923V20.3887H126.946ZM134.408 25.5059L137.083 19.6211H136.385L131.896 8.85163H135.129L138.362 16.9694L141.735 8.85163H144.898L137.571 25.5059H134.408Z"
                          class="fill-primary-500"
                        />
                        <rect x="0.287109" width="26.9297" height="23.3604" rx="6.41893" class="fill-primary-500" />
                        <path
                          d="M28.5524 7.40039H17.7207C15.3573 7.40039 13.4414 9.31629 13.4414 11.6797C13.4414 14.0431 15.3573 15.959 17.7207 15.959H28.5524V7.40039Z"
                          class="fill-primary-100"
                        />
                        <circle cx="17.5771" cy="11.6797" r="2.13964" class="fill-primary-500" />
                      </svg>
                      <h3 class="before:content-[open-quote] after:content-[close-quote]">
                        Implementing HRM has revolutionized our sales process. The intuitive interface and robust features make managing leads.
                      </h3>
                    </div>
                    <div class="p-4 sm:p-6 flex flex-row gap-2 sm:gap-3 bg-neutral-200 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                      <div class="flex flex-col gap-3 justify-center items-center w-full text-center">
                        <img src="../assets/images/user/avatar1.png" alt="images" class="w-[60px] h-[60px] rounded-full" />
                        <div class="flex gap-1 flex-col justify-center">
                          <h5>Tricia Wolf</h5>
                          <div class="body2 text-theme-text-secondary">Sales Manager</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block">
              <div class="flex flex-row items-end justify-center gap-3">
                <button
                  class="slide-prev flex items-center justify-center hover:bg-black/[.04] dark:hover:bg-white/[.09] w-16 h-16 rounded-full border border-neutral-600"
                >
                  <i class="ti ti-arrow-left text-primary-500 text-2xl leading-none"></i>
                </button>
                <button
                  class="slide-next flex items-center justify-center hover:bg-black/[.04] dark:hover:bg-white/[.09] w-16 h-16 rounded-full border border-neutral-600"
                >
                  <i class="ti ti-arrow-right text-primary-500 text-2xl leading-none"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="../assets/js/plugins/tiny-slider.js"></script>
    <script type="module">
      document.addEventListener('DOMContentLoaded', function () {
        var slider = tns({
          container: '.testimonial-5-slider',
          items: 1,
          center:false,
          nav: false,
          autoHeight: false,
          speed: 500,
          gutter: 12,
          autoplayTimeout: 6000,
          slideBy: 1,
          loop: true,
          controls: false,
          autoplay: true,
          autoplayButtonOutput: false,
          autoplayButton: false,
          edgePadding:20,
          mouseDrag:true,
          responsive: {
            575: {
              items: 1,
              edgePadding:100,
            },
            768:{
              items: 1,
              edgePadding:100,
            },
            1000:{
              items: 2,
            },
            1266:{
              edgePadding:280,
            }
          }
        });
        // Select all previous and next buttons
        const prevButtons = document.querySelectorAll('.slide-prev');
        const nextButtons = document.querySelectorAll('.slide-next');

        // Add event listener to each 'prev' button
        prevButtons.forEach(function (button) {
          button.onclick = function () {
            slider.goTo('prev');
          };
        });

        // Add event listener to each 'next' button
        nextButtons.forEach(function (button) {
          button.onclick = function () {
            slider.goTo('next');
          };
        });
      });
    </script>
    <!-- [ Testimonial ] end -->

    <link rel="stylesheet" href="../assets/css/plugins/tiny-slider.css" />
    <!-- [ Call To Action ] start -->
    <section class="common-section">
      <div class="container">
        <div class="animate-y delay-reset rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden relative">
          <div class="flex flex-col gap-12 md:gap-16 p-6 sm:p-8 md:p-16">
            <div class="flex flex-col items-center gap-6 sm:gap-8 md:gap-10 text-center">
              <div class="flex flex-col items-center gap-4 sm:gap-5">
                <div class="relative flex items-center justify-center">
                  <i class="ti ti-cloud-up text-2xl leading-none absolute z-10 text-primary-500"></i>
                  <!-- [ img starfab ] start -->
                  <svg class="w-[55px] h-[55px]" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M47.552 4.67508L45.6912 3.14787C43.5455 1.38675 40.4545 1.38675 38.3088 3.14787L36.448 4.67509C35.6785 5.30667 34.6395 5.50091 33.6937 5.18995L31.407 4.43804C28.7699 3.57097 25.8877 4.68757 24.523 7.10489L23.3396 9.20116C22.8502 10.0681 21.9515 10.6245 20.9573 10.6762L18.5533 10.8012C15.7812 10.9452 13.4969 13.0276 13.0976 15.7747L12.7514 18.1569C12.6082 19.1421 11.9712 19.9856 11.0628 20.3929L8.86631 21.3779C6.33339 22.5136 4.95561 25.2806 5.57567 27.9864L6.11338 30.3328C6.33575 31.3031 6.04647 32.3198 5.34657 33.0278L3.65418 34.7397C1.70259 36.7138 1.41739 39.7916 2.97302 42.0907L4.32203 44.0844C4.87993 44.9089 4.97746 45.9614 4.58057 46.8744L3.62087 49.0821C2.51418 51.6278 3.36008 54.6008 5.64117 56.1827L7.61931 57.5545C8.43737 58.1218 8.90854 59.068 8.86826 60.0627L8.77086 62.468C8.65855 65.2416 10.5213 67.7083 13.2198 68.3593L15.5599 68.9239C16.5276 69.1573 17.3088 69.8695 17.6306 70.8115L18.4086 73.0896C19.3059 75.7165 21.9339 77.3437 24.6853 76.9759L27.0713 76.657C28.0581 76.5251 29.0438 76.907 29.6841 77.6692L31.2326 79.5123C33.0181 81.6377 36.0565 82.2057 38.4893 80.8689L40.599 79.7096C41.4715 79.2301 42.5285 79.2301 43.401 79.7096L45.5107 80.8689C47.9435 82.2057 50.9818 81.6377 52.7674 79.5123L54.3159 77.6692C54.9562 76.907 55.9419 76.5251 56.9286 76.657L59.3147 76.9759C62.0661 77.3437 64.6941 75.7165 65.5914 73.0896L66.3694 70.8115C66.6912 69.8695 67.4724 69.1573 68.4401 68.9239L70.7802 68.3593C73.4787 67.7083 75.3414 65.2416 75.2291 62.468L75.1317 60.0627C75.0915 59.068 75.5626 58.1218 76.3807 57.5545L78.3588 56.1827C80.6399 54.6008 81.4858 51.6278 80.3791 49.0821L79.4194 46.8744C79.0225 45.9614 79.1201 44.9089 79.678 44.0844L81.027 42.0907C82.5826 39.7916 82.2974 36.7138 80.3458 34.7397L78.6534 33.0278C77.9535 32.3198 77.6642 31.3031 77.8866 30.3328L78.4243 27.9864C79.0444 25.2806 77.6666 22.5136 75.1337 21.3779L72.9372 20.3929C72.0288 19.9856 71.3918 19.1421 71.2486 18.1569L70.9024 15.7747C70.5031 13.0276 68.2188 10.9452 65.4467 10.8012L63.0427 10.6762C62.0485 10.6245 61.1498 10.0681 60.6604 9.20115L59.477 7.10489C58.1123 4.68757 55.2301 3.57097 52.593 4.43804L50.3062 5.18995C49.3605 5.50091 48.3215 5.30667 47.552 4.67508Z"
                      fill="url(#paint0_linear_5005_3474)"
                      stroke="url(#paint1_linear_5005_3474)"
                      stroke-width="2.90909"
                    />
                    <defs>
                      <linearGradient id="paint0_linear_5005_3474" x1="82" y1="42" x2="2" y2="42" gradientUnits="userSpaceOnUse">
                        <stop stop-color="var(--secondary-100)" />
                        <stop offset="1" stop-color="var(--neutral-100)" />
                      </linearGradient>
                      <linearGradient id="paint1_linear_5005_3474" x1="84.8571" y1="42.7143" x2="-3" y2="42.7143" gradientUnits="userSpaceOnUse">
                        <stop stop-color="var(--neutral-100)" />
                        <stop offset="1" stop-color="var(--secondary-100)" />
                      </linearGradient>
                    </defs>
                  </svg>
                </div>
                <div class="flex flex-col gap-2">
                  <h2>Unlock Your HR Potential Today!</h2>
                  <p class="h6 max-w-[478px] mx-auto text-theme-text-secondary">
                    Take the first step towards HR excellence. Sign up now for a demo.
                  </p>
                </div>
              </div>
              <div class="relative max-sm:w-full">
                <div class="absolute -top-2.5 ltr:left-[-25px] rtl:right-[-25px] rtl:-scale-x-100 text-primary-500">
                  <!-- [ Arrow ] -->
                  <svg class="w-[30px] h-[21px] stroke-[3px]" viewBox="0 0 30 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M24.8936 1.85913C24.8936 4.97291 26.3909 7.91338 28 10.4879"
                      stroke="currentColor"
                      strokeWidth="3"
                      strokeLinecap="round"
                    />
                    <path
                      d="M24.4023 14.8591C23.0717 13.8412 21.639 13.0273 20.2525 12.1793C17.563 10.5343 14.8602 8.9136 12.1233 7.42679C8.93329 5.69387 5.68273 4.21606 2.40234 2.85913"
                      stroke="currentColor"
                      strokeWidth="3"
                      strokeLinecap="round"
                    />
                    <path
                      d="M19.5312 17.7869C17.195 17.7869 14.8892 17.8994 12.5741 18.2406C10.8123 18.5003 9.04694 18.9714 7.28067 19.148"
                      stroke="currentColor"
                      strokeWidth="3"
                      strokeLinecap="round"
                    />
                  </svg>
                </div>
                <div class="relative w-[340px] max-w-full">
                  <button
                    class="btn btn-primary absolute top-1 ltr:right-1 rtl:left-1 py-[15px] px-8 min-w-[110px] md:min-w-[120px] leading-[1.2]"
                  >
                    Get Started
                  </button>
                  <input
                    type="search"
                    class="form-control py-[15.2px] ltr:pl-6 rtl:pr-6 ltr:pr-16 rtl:pl-16 rounded-full bg-neutral-100"
                    placeholder="Enter email"
                  />
                </div>
              </div>
              <div class="relative overflow-hidden w-full" dir="ltr">
                <span class="absolute h-full w-[13px] sm:w-[119px] top-0 left-0 z-10 bg-[linear-gradient(90deg,var(--neutral-100)_-8.54%,_transparent_100%)]"></span>
                <div class="cta-6-slider">
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 136 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M19.9316 5.3949C19.9316 3.57484 22.1451 2.67781 23.4122 3.98435L35.0876 16.0232C35.8566 16.816 36.2866 17.8771 36.2866 18.9816V32.9165C36.2866 34.7365 34.0732 35.6335 32.8061 34.327L21.1306 22.2882C20.3617 21.4953 19.9316 20.4342 19.9316 19.3297V5.3949Z"
                            class="fill-primary-100" />
                          <path
                            d="M9.79688 4.99939C9.79688 3.17933 12.0103 2.2823 13.2774 3.58884L24.7806 15.45C25.66 16.3568 26.1518 17.5704 26.1518 18.8336V32.521C26.1518 34.341 23.9384 35.238 22.6713 33.9315L10.9958 21.8927C10.2269 21.0998 9.79688 20.0387 9.79688 18.9342V4.99939Z"
                            class="fill-primary-500" />
                          <path
                            d="M0 5.3949C0 3.57484 2.21342 2.67781 3.48052 3.98435L15.156 16.0232C15.9249 16.816 16.3549 17.8771 16.3549 18.9816V32.9165C16.3549 34.7365 14.1415 35.6335 12.8744 34.327L1.19896 22.2882C0.430024 21.4953 0 20.4342 0 19.3297V5.3949Z"
                            class="fill-primary-500" />
                          <path
                            d="M51.6602 26.458V12.5717H46.9151V10.1759H59.4058V12.5717H54.6375V26.458H51.6602ZM65.0575 26.7371C63.8945 26.7371 62.8633 26.489 61.9639 25.9928C61.0645 25.4966 60.359 24.7988 59.8472 23.8994C59.3355 23 59.0797 21.961 59.0797 20.7825C59.0797 19.5885 59.3278 18.5263 59.824 17.5959C60.3357 16.6655 61.0335 15.9444 61.9174 15.4327C62.8168 14.9055 63.8713 14.6418 65.0808 14.6418C66.2128 14.6418 67.213 14.8899 68.0813 15.3862C68.9497 15.8824 69.6243 16.5647 70.105 17.4331C70.6012 18.2859 70.8493 19.2396 70.8493 20.2941C70.8493 20.4646 70.8416 20.643 70.826 20.829C70.826 21.0151 70.8183 21.209 70.8028 21.4105H62.0337C62.0957 22.3099 62.4059 23.0155 62.9641 23.5272C63.5379 24.0389 64.2279 24.2948 65.0343 24.2948C65.639 24.2948 66.143 24.163 66.5462 23.8994C66.9649 23.6203 67.275 23.2636 67.4766 22.8294H70.5004C70.2833 23.5582 69.9189 24.225 69.4072 24.8298C68.911 25.4191 68.2907 25.8843 67.5464 26.2254C66.8175 26.5666 65.9879 26.7371 65.0575 26.7371ZM65.0808 17.0609C64.352 17.0609 63.7084 17.2702 63.1502 17.6889C62.5919 18.0921 62.2353 18.7124 62.0802 19.5497H67.8255C67.779 18.7899 67.4998 18.1851 66.9881 17.7354C66.4764 17.2857 65.8406 17.0609 65.0808 17.0609ZM79.0056 26.7371C77.8271 26.7371 76.7882 26.4813 75.8888 25.9695C74.9894 25.4578 74.2761 24.7445 73.7488 23.8296C73.2371 22.9147 72.9812 21.868 72.9812 20.6895C72.9812 19.511 73.2371 18.4643 73.7488 17.5494C74.2761 16.6345 74.9894 15.9211 75.8888 15.4094C76.7882 14.8977 77.8271 14.6418 79.0056 14.6418C80.4788 14.6418 81.7193 15.0295 82.7273 15.8048C83.7352 16.5647 84.3787 17.6191 84.6579 18.9682H81.5177C81.3627 18.41 81.0525 17.9758 80.5873 17.6657C80.1376 17.34 79.6026 17.1772 78.9824 17.1772C78.1605 17.1772 77.4627 17.4873 76.889 18.1076C76.3152 18.7279 76.0283 19.5885 76.0283 20.6895C76.0283 21.7905 76.3152 22.6511 76.889 23.2714C77.4627 23.8916 78.1605 24.2018 78.9824 24.2018C79.6026 24.2018 80.1376 24.0467 80.5873 23.7366C81.0525 23.4264 81.3627 22.9845 81.5177 22.4107H84.6579C84.3787 23.7133 83.7352 24.76 82.7273 25.5509C81.7193 26.3417 80.4788 26.7371 79.0056 26.7371ZM87.3004 26.458V9.71068H90.2777V16.6887C90.6654 16.053 91.1849 15.5567 91.8362 15.2001C92.503 14.8279 93.2628 14.6418 94.1157 14.6418C95.5423 14.6418 96.6433 15.0915 97.4186 15.9909C98.2094 16.8903 98.6049 18.2084 98.6049 19.9452V26.458H95.6508V20.2243C95.6508 19.2318 95.4492 18.472 95.0461 17.9448C94.6584 17.4176 94.0381 17.1539 93.1853 17.1539C92.3479 17.1539 91.6501 17.4486 91.0918 18.0378C90.5491 18.6271 90.2777 19.4489 90.2777 20.5034V26.458H87.3004ZM101.452 26.458V9.71068H104.429V26.458H101.452ZM109.076 13.1299C108.534 13.1299 108.084 12.9671 107.727 12.6415C107.386 12.3158 107.215 11.9049 107.215 11.4087C107.215 10.9125 107.386 10.5093 107.727 10.1991C108.084 9.8735 108.534 9.71068 109.076 9.71068C109.619 9.71068 110.061 9.8735 110.402 10.1991C110.759 10.5093 110.937 10.9125 110.937 11.4087C110.937 11.9049 110.759 12.3158 110.402 12.6415C110.061 12.9671 109.619 13.1299 109.076 13.1299ZM107.588 26.458V14.921H110.565V26.458H107.588ZM114.208 26.458V17.4098H112.626V14.921H114.208V13.5719C114.208 12.1763 114.556 11.1838 115.254 10.5946C115.968 10.0053 116.929 9.71068 118.139 9.71068H119.418V12.246H118.604C118.092 12.246 117.728 12.3468 117.51 12.5484C117.293 12.75 117.185 13.0912 117.185 13.5719V14.921H119.674V17.4098H117.185V26.458H114.208ZM123.474 31.5752L126.149 25.6904H125.451L120.962 14.921H124.195L127.428 23.0388L130.801 14.921H133.964L126.637 31.5752H123.474Z"
                            class="fill-primary-500" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 132 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M34.068 20V3.71788H37.6036L42.7906 14.0454L47.9078 3.71788H51.4434V20H48.4661V8.76534L43.9303 17.674H41.5811L37.0453 8.76534V20H34.068ZM58.5101 20.2791C57.5177 20.2791 56.7036 20.1241 56.0678 19.8139C55.432 19.4883 54.959 19.0618 54.6489 18.5346C54.3388 18.0074 54.1837 17.4259 54.1837 16.7901C54.1837 15.7201 54.6024 14.8517 55.4398 14.185C56.2771 13.5182 57.5332 13.1848 59.2079 13.1848H62.1387V12.9056C62.1387 12.1148 61.9138 11.5333 61.4641 11.1611C61.0144 10.789 60.4562 10.6029 59.7894 10.6029C59.1846 10.6029 58.6574 10.7502 58.2077 11.0448C57.758 11.324 57.4789 11.7426 57.3704 12.3009H54.4628C54.5404 11.4635 54.8195 10.7347 55.3002 10.1144C55.7964 9.49415 56.4322 9.0212 57.2075 8.69555C57.9829 8.35441 58.8513 8.18383 59.8127 8.18383C61.4564 8.18383 62.7512 8.59476 63.6971 9.41662C64.643 10.2385 65.116 11.4015 65.116 12.9056V20H62.5806L62.3015 18.1392C61.9604 18.7595 61.4797 19.2712 60.8594 19.6744C60.2546 20.0775 59.4715 20.2791 58.5101 20.2791ZM59.1846 17.9531C60.0375 17.9531 60.6966 17.674 61.1618 17.1157C61.6425 16.5575 61.9449 15.8674 62.0689 15.0456H59.5335C58.7427 15.0456 58.1767 15.1929 57.8356 15.4875C57.4944 15.7666 57.3238 16.1156 57.3238 16.5342C57.3238 16.9839 57.4944 17.3328 57.8356 17.5809C58.1767 17.8291 58.6264 17.9531 59.1846 17.9531ZM67.9572 20V8.46295H70.6088L70.888 10.6261C71.3067 9.88182 71.8726 9.29257 72.586 8.85838C73.3148 8.40868 74.1677 8.18383 75.1446 8.18383V11.324H74.3072C73.6559 11.324 73.0744 11.4247 72.5627 11.6263C72.051 11.8279 71.6478 12.1768 71.3532 12.673C71.074 13.1693 70.9345 13.8593 70.9345 14.7432V20H67.9572ZM77.1795 20V3.25267H80.1568V13.1382L84.2506 8.46295H87.7861L83.0643 13.7198L88.5537 20H84.8321L80.1568 14.2082V20H77.1795ZM95.0513 20.2791C93.8883 20.2791 92.8571 20.031 91.9577 19.5348C91.0583 19.0386 90.3527 18.3408 89.841 17.4414C89.3293 16.542 89.0734 15.503 89.0734 14.3245C89.0734 13.1305 89.3215 12.0683 89.8178 11.1379C90.3295 10.2075 91.0273 9.4864 91.9112 8.97468C92.8106 8.44745 93.865 8.18383 95.0746 8.18383C96.2065 8.18383 97.2067 8.43194 98.0751 8.92816C98.9435 9.42437 99.618 10.1067 100.099 10.9751C100.595 11.8279 100.843 12.7816 100.843 13.8361C100.843 14.0066 100.835 14.185 100.82 14.371C100.82 14.5571 100.812 14.751 100.797 14.9525H92.0275C92.0895 15.8519 92.3996 16.5575 92.9579 17.0692C93.5316 17.5809 94.2217 17.8368 95.028 17.8368C95.6328 17.8368 96.1368 17.705 96.5399 17.4414C96.9586 17.1623 97.2688 16.8056 97.4703 16.3714H100.494C100.277 17.1002 99.9127 17.767 99.4009 18.3718C98.9047 18.961 98.2845 19.4262 97.5401 19.7674C96.8113 20.1085 95.9817 20.2791 95.0513 20.2791ZM95.0746 10.6029C94.3457 10.6029 93.7022 10.8122 93.144 11.2309C92.5857 11.6341 92.2291 12.2544 92.074 13.0917H97.8193C97.7727 12.3319 97.4936 11.7271 96.9819 11.2774C96.4702 10.8277 95.8344 10.6029 95.0746 10.6029ZM108.283 20C107.074 20 106.105 19.7054 105.376 19.1161C104.647 18.5269 104.282 17.4801 104.282 15.976V10.9518H102.305V8.46295H104.282L104.631 5.36935H107.26V8.46295H110.377V10.9518H107.26V15.9992C107.26 16.5575 107.376 16.9452 107.609 17.1623C107.857 17.3638 108.275 17.4646 108.865 17.4646H110.307V20H108.283ZM112.933 20V3.25267H115.91V20H112.933ZM120.395 25.1172L123.069 19.2324H122.372L117.882 8.46295H121.116L124.349 16.5808L127.721 8.46295H130.885L123.558 25.1172H120.395Z"
                            class="fill-primary-500" />
                          <rect x="0.845703" y="14.8545" width="5.91373" height="9.19306" rx="2.95687" class="fill-primary-500" />
                          <rect x="0.845703" y="0.783203" width="5.91373" height="5.91373" rx="2.95687" class="fill-primary-500" />
                          <rect x="9.44922" y="7.62695" width="5.91373" height="16.4206" rx="2.95687" class="fill-primary-500" />
                          <rect x="18.0547" y="0.783203" width="5.91373" height="23.2642" rx="2.95687" class="fill-primary-100" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 115 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M36.4411 20V3.71788H42.4189C43.7215 3.71788 44.7915 3.94273 45.6288 4.39242C46.4817 4.82661 47.1175 5.42362 47.5362 6.18346C47.9549 6.92778 48.1642 7.75739 48.1642 8.67229C48.1642 9.66473 47.9006 10.5719 47.3733 11.3937C46.8616 12.2156 46.0553 12.8126 44.9543 13.1848L48.327 20H44.9078L41.8839 13.5802H39.4184V20H36.4411ZM39.4184 11.3937H42.2329C43.2253 11.3937 43.9541 11.1534 44.4193 10.6727C44.8845 10.192 45.1171 9.55618 45.1171 8.76534C45.1171 7.99 44.8845 7.36972 44.4193 6.90452C43.9696 6.43932 43.233 6.20672 42.2096 6.20672H39.4184V11.3937ZM55.765 20.2791C54.602 20.2791 53.5708 20.031 52.6714 19.5348C51.772 19.0386 51.0664 18.3408 50.5547 17.4414C50.043 16.542 49.7871 15.503 49.7871 14.3245C49.7871 13.1305 50.0352 12.0683 50.5315 11.1379C51.0432 10.2075 51.741 9.4864 52.6249 8.97468C53.5243 8.44745 54.5787 8.18383 55.7883 8.18383C56.9203 8.18383 57.9204 8.43194 58.7888 8.92816C59.6572 9.42437 60.3317 10.1067 60.8125 10.9751C61.3087 11.8279 61.5568 12.7816 61.5568 13.8361C61.5568 14.0066 61.549 14.185 61.5335 14.371C61.5335 14.5571 61.5258 14.751 61.5103 14.9525H52.7412C52.8032 15.8519 53.1133 16.5575 53.6716 17.0692C54.2453 17.5809 54.9354 17.8368 55.7417 17.8368C56.3465 17.8368 56.8505 17.705 57.2537 17.4414C57.6723 17.1623 57.9825 16.8056 58.1841 16.3714H61.2079C60.9908 17.1002 60.6264 17.767 60.1147 18.3718C59.6184 18.961 58.9982 19.4262 58.2538 19.7674C57.525 20.1085 56.6954 20.2791 55.765 20.2791ZM55.7883 10.6029C55.0594 10.6029 54.4159 10.8122 53.8577 11.2309C53.2994 11.6341 52.9428 12.2544 52.7877 13.0917H58.533C58.4864 12.3319 58.2073 11.7271 57.6956 11.2774C57.1839 10.8277 56.5481 10.6029 55.7883 10.6029ZM68.0384 20.2791C67.0459 20.2791 66.2318 20.1241 65.5961 19.8139C64.9603 19.4883 64.4873 19.0618 64.1772 18.5346C63.8671 18.0074 63.712 17.4259 63.712 16.7901C63.712 15.7201 64.1307 14.8517 64.968 14.185C65.8054 13.5182 67.0615 13.1848 68.7362 13.1848H71.667V12.9056C71.667 12.1148 71.4421 11.5333 70.9924 11.1611C70.5427 10.789 69.9845 10.6029 69.3177 10.6029C68.7129 10.6029 68.1857 10.7502 67.736 11.0448C67.2863 11.324 67.0072 11.7426 66.8986 12.3009H63.9911C64.0686 11.4635 64.3478 10.7347 64.8285 10.1144C65.3247 9.49415 65.9605 9.0212 66.7358 8.69555C67.5111 8.35441 68.3795 8.18383 69.3409 8.18383C70.9847 8.18383 72.2795 8.59476 73.2254 9.41662C74.1713 10.2385 74.6443 11.4015 74.6443 12.9056V20H72.1089L71.8298 18.1392C71.4886 18.7595 71.0079 19.2712 70.3877 19.6744C69.7829 20.0775 68.9998 20.2791 68.0384 20.2791ZM68.7129 17.9531C69.5658 17.9531 70.2248 17.674 70.69 17.1157C71.1707 16.5575 71.4731 15.8674 71.5972 15.0456H69.0618C68.271 15.0456 67.705 15.1929 67.3638 15.4875C67.0227 15.7666 66.8521 16.1156 66.8521 16.5342C66.8521 16.9839 67.0227 17.3328 67.3638 17.5809C67.705 17.8291 68.1547 17.9531 68.7129 17.9531ZM77.4855 20V3.25267H80.4628V20H77.4855ZM88.6454 20C87.4359 20 86.4667 19.7054 85.7379 19.1161C85.0091 18.5269 84.6447 17.4801 84.6447 15.976V10.9518H82.6676V8.46295H84.6447L84.9936 5.36935H87.622V8.46295H90.7389V10.9518H87.622V15.9992C87.622 16.5575 87.7383 16.9452 87.9709 17.1623C88.219 17.3638 88.6377 17.4646 89.2269 17.4646H90.6691V20H88.6454ZM98.5357 20.2791C97.4192 20.2791 96.4113 20.0233 95.5119 19.5115C94.628 18.9998 93.9225 18.2943 93.3952 17.3949C92.8835 16.48 92.6277 15.4255 92.6277 14.2315C92.6277 13.0375 92.8913 11.9907 93.4185 11.0914C93.9457 10.1765 94.6513 9.46314 95.5352 8.95142C96.4346 8.43969 97.4425 8.18383 98.559 8.18383C99.66 8.18383 100.652 8.43969 101.536 8.95142C102.436 9.46314 103.141 10.1765 103.653 11.0914C104.18 11.9907 104.444 13.0375 104.444 14.2315C104.444 15.4255 104.18 16.48 103.653 17.3949C103.141 18.2943 102.436 18.9998 101.536 19.5115C100.637 20.0233 99.6367 20.2791 98.5357 20.2791ZM98.5357 17.6972C99.3111 17.6972 99.9856 17.4104 100.559 16.8366C101.133 16.2474 101.42 15.379 101.42 14.2315C101.42 13.084 101.133 12.2233 100.559 11.6496C99.9856 11.0603 99.3188 10.7657 98.559 10.7657C97.7682 10.7657 97.0859 11.0603 96.5121 11.6496C95.9539 12.2233 95.6747 13.084 95.6747 14.2315C95.6747 15.379 95.9539 16.2474 96.5121 16.8366C97.0859 17.4104 97.7604 17.6972 98.5357 17.6972ZM107.106 20V8.46295H109.757L110.037 10.6261C110.455 9.88182 111.021 9.29257 111.735 8.85838C112.463 8.40868 113.316 8.18383 114.293 8.18383V11.324H113.456C112.805 11.324 112.223 11.4247 111.711 11.6263C111.2 11.8279 110.796 12.1768 110.502 12.673C110.223 13.1693 110.083 13.8593 110.083 14.7432V20H107.106Z"
                            class="fill-primary-500"
                          />
                          <path
                            d="M0.929688 1.80261C0.929688 1.0832 1.51288 0.5 2.23229 0.5H6.62708C7.34649 0.5 7.92969 1.0832 7.92969 1.80261V15.5H0.929688V1.80261Z"
                            class="fill-primary-100"
                          />
                          <path
                            d="M1.2219 26.3364H23.6777C24.0839 26.3364 24.4132 26.0071 24.4132 25.6008V12.2911C24.4132 12.0734 24.3169 11.867 24.1501 11.7272L12.9222 2.31965C12.6489 2.09065 12.2507 2.09065 11.9774 2.31965L0.749488 11.7272C0.582685 11.867 0.486328 12.0734 0.486328 12.2911V25.6008C0.486328 26.0071 0.815656 26.3364 1.2219 26.3364Z"
                            class="fill-primary-500"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 146 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M38.4274 20.3887V4.10655H48.941V6.50235H41.4047V11.0613H47.4989V13.4106H41.4047V20.3887H38.4274ZM52.7738 7.06059C52.2311 7.06059 51.7814 6.89777 51.4247 6.57213C51.0836 6.24649 50.913 5.83556 50.913 5.33934C50.913 4.84312 51.0836 4.43995 51.4247 4.12981C51.7814 3.80417 52.2311 3.64135 52.7738 3.64135C53.3166 3.64135 53.7585 3.80417 54.0997 4.12981C54.4563 4.43995 54.6346 4.84312 54.6346 5.33934C54.6346 5.83556 54.4563 6.24649 54.0997 6.57213C53.7585 6.89777 53.3166 7.06059 52.7738 7.06059ZM51.2852 20.3887V8.85163H54.2625V20.3887H51.2852ZM57.3701 20.3887V8.85163H59.9985L60.2311 10.8055C60.5877 10.1232 61.0995 9.58044 61.7663 9.17727C62.4486 8.77409 63.2472 8.5725 64.1621 8.5725C65.5887 8.5725 66.6974 9.0222 67.4883 9.92159C68.2791 10.821 68.6745 12.1391 68.6745 13.8758V20.3887H65.6972V14.1549C65.6972 13.1625 65.4956 12.4027 65.0925 11.8754C64.6893 11.3482 64.0613 11.0846 63.2084 11.0846C62.371 11.0846 61.681 11.3792 61.1382 11.9685C60.611 12.5577 60.3474 13.3796 60.3474 14.4341V20.3887H57.3701ZM75.499 20.6678C74.5066 20.6678 73.6925 20.5127 73.0567 20.2026C72.4209 19.8769 71.948 19.4505 71.6378 18.9233C71.3277 18.3961 71.1726 17.8145 71.1726 17.1788C71.1726 16.1088 71.5913 15.2404 72.4287 14.5736C73.266 13.9068 74.5221 13.5734 76.1968 13.5734H79.1276V13.2943C79.1276 12.5035 78.9028 11.922 78.4531 11.5498C78.0034 11.1776 77.4451 10.9916 76.7783 10.9916C76.1736 10.9916 75.6463 11.1389 75.1966 11.4335C74.7469 11.7126 74.4678 12.1313 74.3593 12.6896H71.4518C71.5293 11.8522 71.8084 11.1234 72.2891 10.5031C72.7853 9.88283 73.4211 9.40987 74.1965 9.08423C74.9718 8.74308 75.8402 8.5725 76.8016 8.5725C78.4453 8.5725 79.7401 8.98343 80.686 9.80529C81.632 10.6272 82.1049 11.7902 82.1049 13.2943V20.3887H79.5696L79.2904 18.5279C78.9493 19.1481 78.4686 19.6599 77.8483 20.063C77.2435 20.4662 76.4604 20.6678 75.499 20.6678ZM76.1736 18.3418C77.0264 18.3418 77.6855 18.0627 78.1507 17.5044C78.6314 16.9462 78.9338 16.2561 79.0578 15.4343H76.5225C75.7316 15.4343 75.1656 15.5816 74.8245 15.8762C74.4833 16.1553 74.3128 16.5042 74.3128 16.9229C74.3128 17.3726 74.4833 17.7215 74.8245 17.9696C75.1656 18.2177 75.6153 18.3418 76.1736 18.3418ZM84.9461 20.3887V8.85163H87.5745L87.8071 10.8055C88.1638 10.1232 88.6755 9.58044 89.3423 9.17727C90.0246 8.77409 90.8232 8.5725 91.7381 8.5725C93.1647 8.5725 94.2734 9.0222 95.0643 9.92159C95.8551 10.821 96.2506 12.1391 96.2506 13.8758V20.3887H93.2733V14.1549C93.2733 13.1625 93.0717 12.4027 92.6685 11.8754C92.2653 11.3482 91.6373 11.0846 90.7844 11.0846C89.947 11.0846 89.257 11.3792 88.7143 11.9685C88.187 12.5577 87.9234 13.3796 87.9234 14.4341V20.3887H84.9461ZM104.75 20.6678C103.571 20.6678 102.532 20.4119 101.633 19.9002C100.734 19.3885 100.02 18.6752 99.493 17.7603C98.9813 16.8454 98.7254 15.7987 98.7254 14.6201C98.7254 13.4416 98.9813 12.3949 99.493 11.48C100.02 10.5651 100.734 9.85181 101.633 9.34009C102.532 8.82837 103.571 8.5725 104.75 8.5725C106.223 8.5725 107.463 8.96017 108.471 9.73551C109.479 10.4953 110.123 11.5498 110.402 12.8989H107.262C107.107 12.3407 106.797 11.9065 106.331 11.5963C105.882 11.2707 105.347 11.1079 104.727 11.1079C103.905 11.1079 103.207 11.418 102.633 12.0383C102.059 12.6585 101.772 13.5192 101.772 14.6201C101.772 15.7211 102.059 16.5818 102.633 17.202C103.207 17.8223 103.905 18.1324 104.727 18.1324C105.347 18.1324 105.882 17.9774 106.331 17.6672C106.797 17.3571 107.107 16.9152 107.262 16.3414H110.402C110.123 17.644 109.479 18.6907 108.471 19.4815C107.463 20.2724 106.223 20.6678 104.75 20.6678ZM118.65 20.6678C117.487 20.6678 116.456 20.4197 115.557 19.9235C114.657 19.4273 113.952 18.7294 113.44 17.8301C112.928 16.9307 112.672 15.8917 112.672 14.7132C112.672 13.5192 112.921 12.457 113.417 11.5265C113.928 10.5961 114.626 9.87507 115.51 9.36335C116.41 8.83612 117.464 8.5725 118.674 8.5725C119.806 8.5725 120.806 8.82061 121.674 9.31683C122.542 9.81305 123.217 10.4953 123.698 11.3637C124.194 12.2166 124.442 13.1703 124.442 14.2247C124.442 14.3953 124.434 14.5736 124.419 14.7597C124.419 14.9458 124.411 15.1396 124.396 15.3412H115.626C115.688 16.2406 115.999 16.9462 116.557 17.4579C117.131 17.9696 117.821 18.2255 118.627 18.2255C119.232 18.2255 119.736 18.0937 120.139 17.8301C120.558 17.5509 120.868 17.1943 121.069 16.7601H124.093C123.876 17.4889 123.512 18.1557 123 18.7605C122.504 19.3497 121.883 19.8149 121.139 20.1561C120.41 20.4972 119.581 20.6678 118.65 20.6678ZM118.674 10.9916C117.945 10.9916 117.301 11.2009 116.743 11.6196C116.185 12.0228 115.828 12.643 115.673 13.4804H121.418C121.372 12.7206 121.093 12.1158 120.581 11.6661C120.069 11.2164 119.433 10.9916 118.674 10.9916ZM126.946 20.3887V3.64135H129.923V20.3887H126.946ZM134.408 25.5059L137.083 19.6211H136.385L131.896 8.85163H135.129L138.362 16.9694L141.735 8.85163H144.898L137.571 25.5059H134.408Z"
                            class="fill-primary-500"
                          />
                          <rect x="0.287109" width="26.9297" height="23.3604" rx="6.41893" class="fill-primary-500" />
                          <path
                            d="M28.5524 7.40039H17.7207C15.3573 7.40039 13.4414 9.31629 13.4414 11.6797C13.4414 14.0431 15.3573 15.959 17.7207 15.959H28.5524V7.40039Z"
                            class="fill-primary-100"
                          />
                          <circle cx="17.5771" cy="11.6797" r="2.13964" class="fill-primary-500" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 136 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M19.9316 5.3949C19.9316 3.57484 22.1451 2.67781 23.4122 3.98435L35.0876 16.0232C35.8566 16.816 36.2866 17.8771 36.2866 18.9816V32.9165C36.2866 34.7365 34.0732 35.6335 32.8061 34.327L21.1306 22.2882C20.3617 21.4953 19.9316 20.4342 19.9316 19.3297V5.3949Z"
                            class="fill-primary-100" />
                          <path
                            d="M9.79688 4.99939C9.79688 3.17933 12.0103 2.2823 13.2774 3.58884L24.7806 15.45C25.66 16.3568 26.1518 17.5704 26.1518 18.8336V32.521C26.1518 34.341 23.9384 35.238 22.6713 33.9315L10.9958 21.8927C10.2269 21.0998 9.79688 20.0387 9.79688 18.9342V4.99939Z"
                            class="fill-primary-500" />
                          <path
                            d="M0 5.3949C0 3.57484 2.21342 2.67781 3.48052 3.98435L15.156 16.0232C15.9249 16.816 16.3549 17.8771 16.3549 18.9816V32.9165C16.3549 34.7365 14.1415 35.6335 12.8744 34.327L1.19896 22.2882C0.430024 21.4953 0 20.4342 0 19.3297V5.3949Z"
                            class="fill-primary-500" />
                          <path
                            d="M51.6602 26.458V12.5717H46.9151V10.1759H59.4058V12.5717H54.6375V26.458H51.6602ZM65.0575 26.7371C63.8945 26.7371 62.8633 26.489 61.9639 25.9928C61.0645 25.4966 60.359 24.7988 59.8472 23.8994C59.3355 23 59.0797 21.961 59.0797 20.7825C59.0797 19.5885 59.3278 18.5263 59.824 17.5959C60.3357 16.6655 61.0335 15.9444 61.9174 15.4327C62.8168 14.9055 63.8713 14.6418 65.0808 14.6418C66.2128 14.6418 67.213 14.8899 68.0813 15.3862C68.9497 15.8824 69.6243 16.5647 70.105 17.4331C70.6012 18.2859 70.8493 19.2396 70.8493 20.2941C70.8493 20.4646 70.8416 20.643 70.826 20.829C70.826 21.0151 70.8183 21.209 70.8028 21.4105H62.0337C62.0957 22.3099 62.4059 23.0155 62.9641 23.5272C63.5379 24.0389 64.2279 24.2948 65.0343 24.2948C65.639 24.2948 66.143 24.163 66.5462 23.8994C66.9649 23.6203 67.275 23.2636 67.4766 22.8294H70.5004C70.2833 23.5582 69.9189 24.225 69.4072 24.8298C68.911 25.4191 68.2907 25.8843 67.5464 26.2254C66.8175 26.5666 65.9879 26.7371 65.0575 26.7371ZM65.0808 17.0609C64.352 17.0609 63.7084 17.2702 63.1502 17.6889C62.5919 18.0921 62.2353 18.7124 62.0802 19.5497H67.8255C67.779 18.7899 67.4998 18.1851 66.9881 17.7354C66.4764 17.2857 65.8406 17.0609 65.0808 17.0609ZM79.0056 26.7371C77.8271 26.7371 76.7882 26.4813 75.8888 25.9695C74.9894 25.4578 74.2761 24.7445 73.7488 23.8296C73.2371 22.9147 72.9812 21.868 72.9812 20.6895C72.9812 19.511 73.2371 18.4643 73.7488 17.5494C74.2761 16.6345 74.9894 15.9211 75.8888 15.4094C76.7882 14.8977 77.8271 14.6418 79.0056 14.6418C80.4788 14.6418 81.7193 15.0295 82.7273 15.8048C83.7352 16.5647 84.3787 17.6191 84.6579 18.9682H81.5177C81.3627 18.41 81.0525 17.9758 80.5873 17.6657C80.1376 17.34 79.6026 17.1772 78.9824 17.1772C78.1605 17.1772 77.4627 17.4873 76.889 18.1076C76.3152 18.7279 76.0283 19.5885 76.0283 20.6895C76.0283 21.7905 76.3152 22.6511 76.889 23.2714C77.4627 23.8916 78.1605 24.2018 78.9824 24.2018C79.6026 24.2018 80.1376 24.0467 80.5873 23.7366C81.0525 23.4264 81.3627 22.9845 81.5177 22.4107H84.6579C84.3787 23.7133 83.7352 24.76 82.7273 25.5509C81.7193 26.3417 80.4788 26.7371 79.0056 26.7371ZM87.3004 26.458V9.71068H90.2777V16.6887C90.6654 16.053 91.1849 15.5567 91.8362 15.2001C92.503 14.8279 93.2628 14.6418 94.1157 14.6418C95.5423 14.6418 96.6433 15.0915 97.4186 15.9909C98.2094 16.8903 98.6049 18.2084 98.6049 19.9452V26.458H95.6508V20.2243C95.6508 19.2318 95.4492 18.472 95.0461 17.9448C94.6584 17.4176 94.0381 17.1539 93.1853 17.1539C92.3479 17.1539 91.6501 17.4486 91.0918 18.0378C90.5491 18.6271 90.2777 19.4489 90.2777 20.5034V26.458H87.3004ZM101.452 26.458V9.71068H104.429V26.458H101.452ZM109.076 13.1299C108.534 13.1299 108.084 12.9671 107.727 12.6415C107.386 12.3158 107.215 11.9049 107.215 11.4087C107.215 10.9125 107.386 10.5093 107.727 10.1991C108.084 9.8735 108.534 9.71068 109.076 9.71068C109.619 9.71068 110.061 9.8735 110.402 10.1991C110.759 10.5093 110.937 10.9125 110.937 11.4087C110.937 11.9049 110.759 12.3158 110.402 12.6415C110.061 12.9671 109.619 13.1299 109.076 13.1299ZM107.588 26.458V14.921H110.565V26.458H107.588ZM114.208 26.458V17.4098H112.626V14.921H114.208V13.5719C114.208 12.1763 114.556 11.1838 115.254 10.5946C115.968 10.0053 116.929 9.71068 118.139 9.71068H119.418V12.246H118.604C118.092 12.246 117.728 12.3468 117.51 12.5484C117.293 12.75 117.185 13.0912 117.185 13.5719V14.921H119.674V17.4098H117.185V26.458H114.208ZM123.474 31.5752L126.149 25.6904H125.451L120.962 14.921H124.195L127.428 23.0388L130.801 14.921H133.964L126.637 31.5752H123.474Z"
                            class="fill-primary-500" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 132 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M34.068 20V3.71788H37.6036L42.7906 14.0454L47.9078 3.71788H51.4434V20H48.4661V8.76534L43.9303 17.674H41.5811L37.0453 8.76534V20H34.068ZM58.5101 20.2791C57.5177 20.2791 56.7036 20.1241 56.0678 19.8139C55.432 19.4883 54.959 19.0618 54.6489 18.5346C54.3388 18.0074 54.1837 17.4259 54.1837 16.7901C54.1837 15.7201 54.6024 14.8517 55.4398 14.185C56.2771 13.5182 57.5332 13.1848 59.2079 13.1848H62.1387V12.9056C62.1387 12.1148 61.9138 11.5333 61.4641 11.1611C61.0144 10.789 60.4562 10.6029 59.7894 10.6029C59.1846 10.6029 58.6574 10.7502 58.2077 11.0448C57.758 11.324 57.4789 11.7426 57.3704 12.3009H54.4628C54.5404 11.4635 54.8195 10.7347 55.3002 10.1144C55.7964 9.49415 56.4322 9.0212 57.2075 8.69555C57.9829 8.35441 58.8513 8.18383 59.8127 8.18383C61.4564 8.18383 62.7512 8.59476 63.6971 9.41662C64.643 10.2385 65.116 11.4015 65.116 12.9056V20H62.5806L62.3015 18.1392C61.9604 18.7595 61.4797 19.2712 60.8594 19.6744C60.2546 20.0775 59.4715 20.2791 58.5101 20.2791ZM59.1846 17.9531C60.0375 17.9531 60.6966 17.674 61.1618 17.1157C61.6425 16.5575 61.9449 15.8674 62.0689 15.0456H59.5335C58.7427 15.0456 58.1767 15.1929 57.8356 15.4875C57.4944 15.7666 57.3238 16.1156 57.3238 16.5342C57.3238 16.9839 57.4944 17.3328 57.8356 17.5809C58.1767 17.8291 58.6264 17.9531 59.1846 17.9531ZM67.9572 20V8.46295H70.6088L70.888 10.6261C71.3067 9.88182 71.8726 9.29257 72.586 8.85838C73.3148 8.40868 74.1677 8.18383 75.1446 8.18383V11.324H74.3072C73.6559 11.324 73.0744 11.4247 72.5627 11.6263C72.051 11.8279 71.6478 12.1768 71.3532 12.673C71.074 13.1693 70.9345 13.8593 70.9345 14.7432V20H67.9572ZM77.1795 20V3.25267H80.1568V13.1382L84.2506 8.46295H87.7861L83.0643 13.7198L88.5537 20H84.8321L80.1568 14.2082V20H77.1795ZM95.0513 20.2791C93.8883 20.2791 92.8571 20.031 91.9577 19.5348C91.0583 19.0386 90.3527 18.3408 89.841 17.4414C89.3293 16.542 89.0734 15.503 89.0734 14.3245C89.0734 13.1305 89.3215 12.0683 89.8178 11.1379C90.3295 10.2075 91.0273 9.4864 91.9112 8.97468C92.8106 8.44745 93.865 8.18383 95.0746 8.18383C96.2065 8.18383 97.2067 8.43194 98.0751 8.92816C98.9435 9.42437 99.618 10.1067 100.099 10.9751C100.595 11.8279 100.843 12.7816 100.843 13.8361C100.843 14.0066 100.835 14.185 100.82 14.371C100.82 14.5571 100.812 14.751 100.797 14.9525H92.0275C92.0895 15.8519 92.3996 16.5575 92.9579 17.0692C93.5316 17.5809 94.2217 17.8368 95.028 17.8368C95.6328 17.8368 96.1368 17.705 96.5399 17.4414C96.9586 17.1623 97.2688 16.8056 97.4703 16.3714H100.494C100.277 17.1002 99.9127 17.767 99.4009 18.3718C98.9047 18.961 98.2845 19.4262 97.5401 19.7674C96.8113 20.1085 95.9817 20.2791 95.0513 20.2791ZM95.0746 10.6029C94.3457 10.6029 93.7022 10.8122 93.144 11.2309C92.5857 11.6341 92.2291 12.2544 92.074 13.0917H97.8193C97.7727 12.3319 97.4936 11.7271 96.9819 11.2774C96.4702 10.8277 95.8344 10.6029 95.0746 10.6029ZM108.283 20C107.074 20 106.105 19.7054 105.376 19.1161C104.647 18.5269 104.282 17.4801 104.282 15.976V10.9518H102.305V8.46295H104.282L104.631 5.36935H107.26V8.46295H110.377V10.9518H107.26V15.9992C107.26 16.5575 107.376 16.9452 107.609 17.1623C107.857 17.3638 108.275 17.4646 108.865 17.4646H110.307V20H108.283ZM112.933 20V3.25267H115.91V20H112.933ZM120.395 25.1172L123.069 19.2324H122.372L117.882 8.46295H121.116L124.349 16.5808L127.721 8.46295H130.885L123.558 25.1172H120.395Z"
                            class="fill-primary-500" />
                          <rect x="0.845703" y="14.8545" width="5.91373" height="9.19306" rx="2.95687" class="fill-primary-500" />
                          <rect x="0.845703" y="0.783203" width="5.91373" height="5.91373" rx="2.95687" class="fill-primary-500" />
                          <rect x="9.44922" y="7.62695" width="5.91373" height="16.4206" rx="2.95687" class="fill-primary-500" />
                          <rect x="18.0547" y="0.783203" width="5.91373" height="23.2642" rx="2.95687" class="fill-primary-100" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 115 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M36.4411 20V3.71788H42.4189C43.7215 3.71788 44.7915 3.94273 45.6288 4.39242C46.4817 4.82661 47.1175 5.42362 47.5362 6.18346C47.9549 6.92778 48.1642 7.75739 48.1642 8.67229C48.1642 9.66473 47.9006 10.5719 47.3733 11.3937C46.8616 12.2156 46.0553 12.8126 44.9543 13.1848L48.327 20H44.9078L41.8839 13.5802H39.4184V20H36.4411ZM39.4184 11.3937H42.2329C43.2253 11.3937 43.9541 11.1534 44.4193 10.6727C44.8845 10.192 45.1171 9.55618 45.1171 8.76534C45.1171 7.99 44.8845 7.36972 44.4193 6.90452C43.9696 6.43932 43.233 6.20672 42.2096 6.20672H39.4184V11.3937ZM55.765 20.2791C54.602 20.2791 53.5708 20.031 52.6714 19.5348C51.772 19.0386 51.0664 18.3408 50.5547 17.4414C50.043 16.542 49.7871 15.503 49.7871 14.3245C49.7871 13.1305 50.0352 12.0683 50.5315 11.1379C51.0432 10.2075 51.741 9.4864 52.6249 8.97468C53.5243 8.44745 54.5787 8.18383 55.7883 8.18383C56.9203 8.18383 57.9204 8.43194 58.7888 8.92816C59.6572 9.42437 60.3317 10.1067 60.8125 10.9751C61.3087 11.8279 61.5568 12.7816 61.5568 13.8361C61.5568 14.0066 61.549 14.185 61.5335 14.371C61.5335 14.5571 61.5258 14.751 61.5103 14.9525H52.7412C52.8032 15.8519 53.1133 16.5575 53.6716 17.0692C54.2453 17.5809 54.9354 17.8368 55.7417 17.8368C56.3465 17.8368 56.8505 17.705 57.2537 17.4414C57.6723 17.1623 57.9825 16.8056 58.1841 16.3714H61.2079C60.9908 17.1002 60.6264 17.767 60.1147 18.3718C59.6184 18.961 58.9982 19.4262 58.2538 19.7674C57.525 20.1085 56.6954 20.2791 55.765 20.2791ZM55.7883 10.6029C55.0594 10.6029 54.4159 10.8122 53.8577 11.2309C53.2994 11.6341 52.9428 12.2544 52.7877 13.0917H58.533C58.4864 12.3319 58.2073 11.7271 57.6956 11.2774C57.1839 10.8277 56.5481 10.6029 55.7883 10.6029ZM68.0384 20.2791C67.0459 20.2791 66.2318 20.1241 65.5961 19.8139C64.9603 19.4883 64.4873 19.0618 64.1772 18.5346C63.8671 18.0074 63.712 17.4259 63.712 16.7901C63.712 15.7201 64.1307 14.8517 64.968 14.185C65.8054 13.5182 67.0615 13.1848 68.7362 13.1848H71.667V12.9056C71.667 12.1148 71.4421 11.5333 70.9924 11.1611C70.5427 10.789 69.9845 10.6029 69.3177 10.6029C68.7129 10.6029 68.1857 10.7502 67.736 11.0448C67.2863 11.324 67.0072 11.7426 66.8986 12.3009H63.9911C64.0686 11.4635 64.3478 10.7347 64.8285 10.1144C65.3247 9.49415 65.9605 9.0212 66.7358 8.69555C67.5111 8.35441 68.3795 8.18383 69.3409 8.18383C70.9847 8.18383 72.2795 8.59476 73.2254 9.41662C74.1713 10.2385 74.6443 11.4015 74.6443 12.9056V20H72.1089L71.8298 18.1392C71.4886 18.7595 71.0079 19.2712 70.3877 19.6744C69.7829 20.0775 68.9998 20.2791 68.0384 20.2791ZM68.7129 17.9531C69.5658 17.9531 70.2248 17.674 70.69 17.1157C71.1707 16.5575 71.4731 15.8674 71.5972 15.0456H69.0618C68.271 15.0456 67.705 15.1929 67.3638 15.4875C67.0227 15.7666 66.8521 16.1156 66.8521 16.5342C66.8521 16.9839 67.0227 17.3328 67.3638 17.5809C67.705 17.8291 68.1547 17.9531 68.7129 17.9531ZM77.4855 20V3.25267H80.4628V20H77.4855ZM88.6454 20C87.4359 20 86.4667 19.7054 85.7379 19.1161C85.0091 18.5269 84.6447 17.4801 84.6447 15.976V10.9518H82.6676V8.46295H84.6447L84.9936 5.36935H87.622V8.46295H90.7389V10.9518H87.622V15.9992C87.622 16.5575 87.7383 16.9452 87.9709 17.1623C88.219 17.3638 88.6377 17.4646 89.2269 17.4646H90.6691V20H88.6454ZM98.5357 20.2791C97.4192 20.2791 96.4113 20.0233 95.5119 19.5115C94.628 18.9998 93.9225 18.2943 93.3952 17.3949C92.8835 16.48 92.6277 15.4255 92.6277 14.2315C92.6277 13.0375 92.8913 11.9907 93.4185 11.0914C93.9457 10.1765 94.6513 9.46314 95.5352 8.95142C96.4346 8.43969 97.4425 8.18383 98.559 8.18383C99.66 8.18383 100.652 8.43969 101.536 8.95142C102.436 9.46314 103.141 10.1765 103.653 11.0914C104.18 11.9907 104.444 13.0375 104.444 14.2315C104.444 15.4255 104.18 16.48 103.653 17.3949C103.141 18.2943 102.436 18.9998 101.536 19.5115C100.637 20.0233 99.6367 20.2791 98.5357 20.2791ZM98.5357 17.6972C99.3111 17.6972 99.9856 17.4104 100.559 16.8366C101.133 16.2474 101.42 15.379 101.42 14.2315C101.42 13.084 101.133 12.2233 100.559 11.6496C99.9856 11.0603 99.3188 10.7657 98.559 10.7657C97.7682 10.7657 97.0859 11.0603 96.5121 11.6496C95.9539 12.2233 95.6747 13.084 95.6747 14.2315C95.6747 15.379 95.9539 16.2474 96.5121 16.8366C97.0859 17.4104 97.7604 17.6972 98.5357 17.6972ZM107.106 20V8.46295H109.757L110.037 10.6261C110.455 9.88182 111.021 9.29257 111.735 8.85838C112.463 8.40868 113.316 8.18383 114.293 8.18383V11.324H113.456C112.805 11.324 112.223 11.4247 111.711 11.6263C111.2 11.8279 110.796 12.1768 110.502 12.673C110.223 13.1693 110.083 13.8593 110.083 14.7432V20H107.106Z"
                            class="fill-primary-500"
                          />
                          <path
                            d="M0.929688 1.80261C0.929688 1.0832 1.51288 0.5 2.23229 0.5H6.62708C7.34649 0.5 7.92969 1.0832 7.92969 1.80261V15.5H0.929688V1.80261Z"
                            class="fill-primary-100"
                          />
                          <path
                            d="M1.2219 26.3364H23.6777C24.0839 26.3364 24.4132 26.0071 24.4132 25.6008V12.2911C24.4132 12.0734 24.3169 11.867 24.1501 11.7272L12.9222 2.31965C12.6489 2.09065 12.2507 2.09065 11.9774 2.31965L0.749488 11.7272C0.582685 11.867 0.486328 12.0734 0.486328 12.2911V25.6008C0.486328 26.0071 0.815656 26.3364 1.2219 26.3364Z"
                            class="fill-primary-500"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="group px-0.5 sm:px-1 md:px-1.5 bg-neutral-100 w-full h-10 sm:h-12 md:h-[60px] rounded-full flex items-center justify-center">
                      <div class="opacity-40 group-hover:opacity-100 transition-all duration-500">
                        <svg class="w-[84px] sm:w-[100px] md:w-[136px] h-[22px] sm:h-[25px] md:h-[38px]" viewBox="0 0 146 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M38.4274 20.3887V4.10655H48.941V6.50235H41.4047V11.0613H47.4989V13.4106H41.4047V20.3887H38.4274ZM52.7738 7.06059C52.2311 7.06059 51.7814 6.89777 51.4247 6.57213C51.0836 6.24649 50.913 5.83556 50.913 5.33934C50.913 4.84312 51.0836 4.43995 51.4247 4.12981C51.7814 3.80417 52.2311 3.64135 52.7738 3.64135C53.3166 3.64135 53.7585 3.80417 54.0997 4.12981C54.4563 4.43995 54.6346 4.84312 54.6346 5.33934C54.6346 5.83556 54.4563 6.24649 54.0997 6.57213C53.7585 6.89777 53.3166 7.06059 52.7738 7.06059ZM51.2852 20.3887V8.85163H54.2625V20.3887H51.2852ZM57.3701 20.3887V8.85163H59.9985L60.2311 10.8055C60.5877 10.1232 61.0995 9.58044 61.7663 9.17727C62.4486 8.77409 63.2472 8.5725 64.1621 8.5725C65.5887 8.5725 66.6974 9.0222 67.4883 9.92159C68.2791 10.821 68.6745 12.1391 68.6745 13.8758V20.3887H65.6972V14.1549C65.6972 13.1625 65.4956 12.4027 65.0925 11.8754C64.6893 11.3482 64.0613 11.0846 63.2084 11.0846C62.371 11.0846 61.681 11.3792 61.1382 11.9685C60.611 12.5577 60.3474 13.3796 60.3474 14.4341V20.3887H57.3701ZM75.499 20.6678C74.5066 20.6678 73.6925 20.5127 73.0567 20.2026C72.4209 19.8769 71.948 19.4505 71.6378 18.9233C71.3277 18.3961 71.1726 17.8145 71.1726 17.1788C71.1726 16.1088 71.5913 15.2404 72.4287 14.5736C73.266 13.9068 74.5221 13.5734 76.1968 13.5734H79.1276V13.2943C79.1276 12.5035 78.9028 11.922 78.4531 11.5498C78.0034 11.1776 77.4451 10.9916 76.7783 10.9916C76.1736 10.9916 75.6463 11.1389 75.1966 11.4335C74.7469 11.7126 74.4678 12.1313 74.3593 12.6896H71.4518C71.5293 11.8522 71.8084 11.1234 72.2891 10.5031C72.7853 9.88283 73.4211 9.40987 74.1965 9.08423C74.9718 8.74308 75.8402 8.5725 76.8016 8.5725C78.4453 8.5725 79.7401 8.98343 80.686 9.80529C81.632 10.6272 82.1049 11.7902 82.1049 13.2943V20.3887H79.5696L79.2904 18.5279C78.9493 19.1481 78.4686 19.6599 77.8483 20.063C77.2435 20.4662 76.4604 20.6678 75.499 20.6678ZM76.1736 18.3418C77.0264 18.3418 77.6855 18.0627 78.1507 17.5044C78.6314 16.9462 78.9338 16.2561 79.0578 15.4343H76.5225C75.7316 15.4343 75.1656 15.5816 74.8245 15.8762C74.4833 16.1553 74.3128 16.5042 74.3128 16.9229C74.3128 17.3726 74.4833 17.7215 74.8245 17.9696C75.1656 18.2177 75.6153 18.3418 76.1736 18.3418ZM84.9461 20.3887V8.85163H87.5745L87.8071 10.8055C88.1638 10.1232 88.6755 9.58044 89.3423 9.17727C90.0246 8.77409 90.8232 8.5725 91.7381 8.5725C93.1647 8.5725 94.2734 9.0222 95.0643 9.92159C95.8551 10.821 96.2506 12.1391 96.2506 13.8758V20.3887H93.2733V14.1549C93.2733 13.1625 93.0717 12.4027 92.6685 11.8754C92.2653 11.3482 91.6373 11.0846 90.7844 11.0846C89.947 11.0846 89.257 11.3792 88.7143 11.9685C88.187 12.5577 87.9234 13.3796 87.9234 14.4341V20.3887H84.9461ZM104.75 20.6678C103.571 20.6678 102.532 20.4119 101.633 19.9002C100.734 19.3885 100.02 18.6752 99.493 17.7603C98.9813 16.8454 98.7254 15.7987 98.7254 14.6201C98.7254 13.4416 98.9813 12.3949 99.493 11.48C100.02 10.5651 100.734 9.85181 101.633 9.34009C102.532 8.82837 103.571 8.5725 104.75 8.5725C106.223 8.5725 107.463 8.96017 108.471 9.73551C109.479 10.4953 110.123 11.5498 110.402 12.8989H107.262C107.107 12.3407 106.797 11.9065 106.331 11.5963C105.882 11.2707 105.347 11.1079 104.727 11.1079C103.905 11.1079 103.207 11.418 102.633 12.0383C102.059 12.6585 101.772 13.5192 101.772 14.6201C101.772 15.7211 102.059 16.5818 102.633 17.202C103.207 17.8223 103.905 18.1324 104.727 18.1324C105.347 18.1324 105.882 17.9774 106.331 17.6672C106.797 17.3571 107.107 16.9152 107.262 16.3414H110.402C110.123 17.644 109.479 18.6907 108.471 19.4815C107.463 20.2724 106.223 20.6678 104.75 20.6678ZM118.65 20.6678C117.487 20.6678 116.456 20.4197 115.557 19.9235C114.657 19.4273 113.952 18.7294 113.44 17.8301C112.928 16.9307 112.672 15.8917 112.672 14.7132C112.672 13.5192 112.921 12.457 113.417 11.5265C113.928 10.5961 114.626 9.87507 115.51 9.36335C116.41 8.83612 117.464 8.5725 118.674 8.5725C119.806 8.5725 120.806 8.82061 121.674 9.31683C122.542 9.81305 123.217 10.4953 123.698 11.3637C124.194 12.2166 124.442 13.1703 124.442 14.2247C124.442 14.3953 124.434 14.5736 124.419 14.7597C124.419 14.9458 124.411 15.1396 124.396 15.3412H115.626C115.688 16.2406 115.999 16.9462 116.557 17.4579C117.131 17.9696 117.821 18.2255 118.627 18.2255C119.232 18.2255 119.736 18.0937 120.139 17.8301C120.558 17.5509 120.868 17.1943 121.069 16.7601H124.093C123.876 17.4889 123.512 18.1557 123 18.7605C122.504 19.3497 121.883 19.8149 121.139 20.1561C120.41 20.4972 119.581 20.6678 118.65 20.6678ZM118.674 10.9916C117.945 10.9916 117.301 11.2009 116.743 11.6196C116.185 12.0228 115.828 12.643 115.673 13.4804H121.418C121.372 12.7206 121.093 12.1158 120.581 11.6661C120.069 11.2164 119.433 10.9916 118.674 10.9916ZM126.946 20.3887V3.64135H129.923V20.3887H126.946ZM134.408 25.5059L137.083 19.6211H136.385L131.896 8.85163H135.129L138.362 16.9694L141.735 8.85163H144.898L137.571 25.5059H134.408Z"
                            class="fill-primary-500"
                          />
                          <rect x="0.287109" width="26.9297" height="23.3604" rx="6.41893" class="fill-primary-500" />
                          <path
                            d="M28.5524 7.40039H17.7207C15.3573 7.40039 13.4414 9.31629 13.4414 11.6797C13.4414 14.0431 15.3573 15.959 17.7207 15.959H28.5524V7.40039Z"
                            class="fill-primary-100"
                          />
                          <circle cx="17.5771" cy="11.6797" r="2.13964" class="fill-primary-500" />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <span class="absolute h-full w-[13px] sm:w-[119px] top-0 right-0 z-10 rotate-180 bg-[linear-gradient(90deg,_var(--neutral-100)_-8.54%,_transparent_100%)]"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="../assets/js/plugins/tiny-slider.js"></script>
    <script type="module">
      document.addEventListener('DOMContentLoaded', function () {
        var slider = tns({
          container: '.cta-6-slider',
          items: 2,
          center:true,
          nav: false,
          speed: 500,
          gutter: 4,
          autoplayTimeout: 6000,
          slideBy: 1,
          loop: true,
          controls: false,
          autoplay: true,
          autoplayButtonOutput: false,
          autoplayButton: false,
          mouseDrag:true,
          responsive: {
            575: {
              items: 4,
              center:false,
            },
            992:{
              items: 5,
            }
          }
        });
      });
    </script>
    <!-- [ Call To Action ] end -->

    <!-- [ Faq ] start -->
    <section class="common-section">
      <div class="container">
        <div class="flex flex-col gap-6 sm:gap-8">
          <div class="flex flex-col sm:flex-row gap-3">
            <div class="basis-full sm:basis-6/12">
              <div class="flex flex-col gap-5 justify-between h-full">
                <div class="animate-y delay-reset flex flex-col gap-2 sm:gap-3">
                  <h2>Frequently Asked Questions </h2>
                  <h6 class="text-theme-textsecondary max-w-[750px]">
                    Find answers to common queries about our HRM platform below.
                  </h6>
                </div>
                <div class="flex flex-col gap-3">
                  <div class="animate-y p-6 sm:p-8 md:p-10 rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden hidden sm:block">
                    <div class="flex flex-col items-start gap-6 sm:gap-8 md:gap-10">
                      <div class="flex flex-col gap-3">
                        <h4>Still Have a Question?</h4>
                        <p class="body1">Feel free to reach out to us if you have any additional questions or need further assistance. We're here to help!</p>
                      </div>
                      <button class="btn btn-primary btn-lg">Get in Touch</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="basis-full sm:basis-6/12">
              <div class="flex flex-col gap-3" id="accordionExample">
                <div class="animate-y px-4 sm:px-6 pt-2 sm:pt-3 pb-3 sm:pb-4 rounded-3xl bg-neutral-100 overflow-hidden">
                  <a href="#" class="group flex flex-row items-center gap-3 relative" data-pc-toggle="collapse" data-pc-target="#collapseOne">
                    <span class="absolute inset-0"></span>
                    <div class="grow">
                      <h4 class="my-2 group-hover:text-primary-500 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]">How do I sign up for the HRM platform?</h4>
                    </div>
                    <div class="leading-none">
                      <i class="ti ti-chevron-down group-hover:text-primary-500 text-xl leading-none inline-block group-[.show]:rotate-180 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]"></i>
                    </div>
                  </a>
                  <div id="collapseOne" class="hidden" aria-labelledby="headingOne" data-pc-parent="#accordionExample">
                    <div class="pt-3">
                      <p class="body1 text-theme-text-secondary">Yes, a HRM system can be a powerful tool for marketing. It helps track customer interactions, segment your audience, and automate marketing campaigns. By analyzing customer data, you can create personalized marketing strategies that improve engagement and conversion rates.</p>
                    </div>
                  </div>
                </div>
                <div class="animate-y px-4 sm:px-6 pt-2 sm:pt-3 pb-3 sm:pb-4 rounded-3xl bg-neutral-100 overflow-hidden">
                  <a href="#" class="group flex flex-row items-center gap-3 relative " data-pc-toggle="collapse" data-pc-target="#collapsetwo">
                    <span class="absolute inset-0"></span>
                    <div class="grow">
                      <h4 class="my-2 group-hover:text-primary-500 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]">Is there a free trial available?</h4>
                    </div>
                    <div class="leading-none">
                      <i class="ti ti-chevron-down group-hover:text-primary-500 text-xl leading-none inline-block group-[.show]:rotate-180 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]"></i>
                    </div>
                  </a>
                  <div id="collapsetwo" class="hidden" aria-labelledby="headingtwo" data-pc-parent="#accordionExample">
                    <div class="pt-3">
                      <p class="body1 text-theme-text-secondary">Our HRM platform helps you manage leads efficiently by providing tools to track and nurture them throughout the sales funnel.</p>
                      <div class="w-full pt-4 md:pt-5">
                        <ul class="*:py-2 *:last:pb-0 *:first:pt-0 leading-none">
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <div class="w-6 h-6 inline-flex items-center justify-center rounded-full bg-theme-bg-paper">
                                  <i class="ti ti-check text-[16px] leading-none text-primary-500"></i>
                                </div>
                              </div>
                              <div class="grow">
                                <p class="body1 text-theme-textsecondary">Use AI to score leads based on engagement and potential.</p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <div class="w-6 h-6 inline-flex items-center justify-center rounded-full bg-theme-bg-paper">
                                  <i class="ti ti-check text-[16px] leading-none text-primary-500"></i>
                                </div>
                              </div>
                              <div class="grow">
                                <p class="body1 text-theme-textsecondary">
                                  Segment leads into categories for targeted communication.
                                </p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <div class="w-6 h-6 inline-flex items-center justify-center rounded-full bg-theme-bg-paper">
                                  <i class="ti ti-check text-[16px] leading-none text-primary-500"></i>
                                </div>
                              </div>
                              <div class="grow">
                                <p class="body1 text-theme-textsecondary">
                                  Automate follow-ups and reminders to ensure timely engagement.
                                </p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="animate-y px-4 sm:px-6 pt-2 sm:pt-3 pb-3 sm:pb-4 rounded-3xl bg-neutral-100 overflow-hidden">
                  <a href="#" class="group flex flex-row items-center gap-3 relative " data-pc-toggle="collapse" data-pc-target="#collapsethree">
                    <span class="absolute inset-0"></span>
                    <div class="grow">
                      <h4 class="my-2 group-hover:text-primary-500 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]">Can I customize the platform to fit my company`s needs?</h4>
                    </div>
                    <div class="leading-none">
                      <i class="ti ti-chevron-down group-hover:text-primary-500 text-xl leading-none inline-block group-[.show]:rotate-180 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]"></i>
                    </div>
                  </a>
                  <div id="collapsethree" class="hidden" aria-labelledby="headingthree" data-pc-parent="#accordionExample">
                    <div class="pt-3">
                      <p class="body1 text-theme-text-secondary">HRM systems offer significant benefits to sales teams by centralizing customer data, automating tasks, and providing insights into sales activities. This helps sales reps focus on building relationships and closing deals more efficiently.</p>
                    </div>
                  </div>
                </div>
                <div class="animate-y px-4 sm:px-6 pt-2 sm:pt-3 pb-3 sm:pb-4 rounded-3xl bg-neutral-100 overflow-hidden">
                  <a href="#" class="group flex flex-row items-center gap-3 relative show3" data-pc-toggle="collapse" data-pc-target="#collapsefour">
                    <span class="absolute inset-0"></span>
                    <div class="grow">
                      <h4 class="my-2 group-hover:text-primary-500 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]">How secure is the HRM platform?</h4>
                    </div>
                    <div class="leading-none">
                      <i class="ti ti-chevron-down group-hover:text-primary-500 text-xl leading-none inline-block group-[.show]:rotate-180 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]"></i>
                    </div>
                  </a>
                  <div id="collapsefour" class="show" aria-labelledby="headingfour" data-pc-parent="#accordionExample">
                    <div class="pt-3">
                      <p class="body1 text-theme-text-secondary">Our platform employs robust security measures to protect your data, including encryption and regular security audits.</p>
                      <div class="pt-4 md:pt-5">
                        <ul class="*:py-2 *:last:pb-0 *:first:pt-0 leading-none">
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <div class="w-6 h-6 inline-flex items-center justify-center rounded-full bg-theme-bg-paper">
                                  <i class="ti ti-check text-[16px] leading-none text-primary-500"></i>
                                </div>
                              </div>
                              <div class="grow">
                                <p class="body1 text-theme-textsecondary">Our platform takes security seriously.</p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <div class="w-6 h-6 inline-flex items-center justify-center rounded-full bg-theme-bg-paper">
                                  <i class="ti ti-check text-[16px] leading-none text-primary-500"></i>
                                </div>
                              </div>
                              <div class="grow">
                                <p class="body1 text-theme-textsecondary">
                                  We employ robust security measures to protect your data.
                                </p>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center gap-[10px]">
                              <div class="shrink-0">
                                <div class="w-6 h-6 inline-flex items-center justify-center rounded-full bg-theme-bg-paper">
                                  <i class="ti ti-check text-[16px] leading-none text-primary-500"></i>
                                </div>
                              </div>
                              <div class="grow">
                                <p class="body1 text-theme-textsecondary">
                                  These measures include encryption and regular security audits.
                                </p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="animate-y px-4 sm:px-6 py-2 sm:py-3 rounded-3xl bg-neutral-100  overflow-hidden">
                  <a href="#" class="group flex flex-row items-center gap-3 relative " data-pc-toggle="collapse" data-pc-target="#collapsefive">
                    <span class="absolute inset-0"></span>
                    <div class="grow">
                      <h4 class="my-2 group-hover:text-primary-500 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]">What kind of support do you offer?</h4>
                    </div>
                    <div class="leading-none">
                      <i class="ti ti-chevron-down group-hover:text-primary-500 text-xl leading-none inline-block group-[.show]:rotate-180 transition duration-150 ease-[cubic-bezier(0.4,0,0.2,1)]"></i>
                    </div>
                  </a>
                  <div id="collapsefive" class="hidden" aria-labelledby="headingfive" data-pc-parent="#accordionExample">
                    <div class="pt-3">
                      <p class="body1 text-theme-text-secondary">A HRM system typically includes several key components such as contact management, lead and opportunity tracking, sales automation, and analytics. These features work together to provide a comprehensive view of customer interactions and support business growth.</p>
                    </div>
                  </div>
                </div>
                <div class="animate-y p-6 sm:p-8 md:p-10 rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden block sm:hidden">
                  <div class="flex flex-col items-start gap-6 sm:gap-8 md:gap-10">
                    <div class="flex flex-col gap-3">
                      <h4>Still Have a Question?</h4>
                      <p class="body1">If you have further questions, feel free to reach out to us. We’re here to help you make the most of your HRM experience.</p>
                    </div>
                    <button class="btn btn-primary btn-lg">Get in Touch</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ Faq ] end -->
    <link rel="stylesheet" href="../assets/css/plugins/tiny-slider.css" />
    <!-- [ Blog ] start -->
    <section class="common-section">
      <div class="flex flex-col gap-8">
        <div class="container">
          <div class="animate-y delay-reset flex flex-col gap-2 sm:gap-3 text-center">
            <h2>Resources for Strategic Growth</h2>
          </div>
        </div>  
        <div class="animate-y relative overflow-hidden" dir="ltr">
          <div class="blog-slider4 flex items-stretch">
            <div class="item">
              <div class="bg-[url('../images/blog/blog1.png')] relative h-[464px] rounded-3xl sm:rounded-[32px] md:rounded-[40px] w-full bg-cover bg-center">
                  <div class="-bottom-[2%] left-0 mb-1 p-6 absolute w-full z-10 select-none bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                  <div class="flex flex-col gap-3">
                    <div class="flex flex-row justify-between items-center flex-wrap gap-2">
                      <div class="flex flex-row gap-2">
                        <span class="bg-neutral-300 px-4 py-2 rounded-full caption text-theme-text-secondary">Technology</span>
                      </div>
                      <p class="caption text-theme-text-secondary text-nowrap">24 Jan 2024</p>
                    </div>
                    <a href="#" class="group flex flex-row items-center gap-5 text-theme-text-primary hover:text-primary-500">
                      <div class="grow">
                        <h4 class="line-clamp-2 text-theme-text-primary hover:text-primary-500 group-hover:text-primary-500">Navigating the Digital Highway: Technology Trends Reshaping the Trucking Industry</h4>
                      </div>
                      <div class="shrink-0">
                        <i class="ti ti-arrow-up-right text-[40px] leading-none"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="bg-[url('../images/blog/blog6.png')] relative h-[464px] rounded-3xl sm:rounded-[32px] md:rounded-[40px] w-full bg-cover bg-center">
                  <div class="-bottom-[2%] left-0 mb-1 p-6 absolute w-full z-10 select-none bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                  <div class="flex flex-col gap-3">
                    <div class="flex flex-row justify-between items-center flex-wrap gap-2">
                      <div class="flex flex-row gap-2">
                        <span class="bg-neutral-300 px-4 py-2 rounded-full caption text-theme-text-secondary">Business</span>
                        <span class="bg-neutral-300 px-4 py-2 rounded-full caption text-theme-text-secondary">Productivity</span>
                      </div>
                      <p class="caption text-theme-text-secondary text-nowrap">12 Feb 2024</p>
                    </div>
                    <a href="#" class="group flex flex-row items-center gap-5 text-theme-text-primary hover:text-primary-500">
                      <div class="grow">
                        <h4 class="line-clamp-2 text-theme-text-primary hover:text-primary-500 group-hover:text-primary-500">Sustainable Practices: The Future of Eco-Friendly Supply Chains</h4>
                      </div>
                      <div class="shrink-0">
                        <i class="ti ti-arrow-up-right text-[40px] leading-none"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="bg-[url('../images/blog/blog4.jpg')] relative h-[464px] rounded-3xl sm:rounded-[32px] md:rounded-[40px] w-full bg-cover bg-center">
                  <div class="-bottom-[2%] left-0 mb-1 p-6 absolute w-full z-10 select-none bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                  <div class="flex flex-col gap-3">
                    <div class="flex flex-row justify-between items-center flex-wrap gap-2">
                      <div class="flex flex-row gap-2">
                        <span class="bg-neutral-300 px-4 py-2 rounded-full caption text-theme-text-secondary">Business</span>
                        <span class="bg-neutral-300 px-4 py-2 rounded-full caption text-theme-text-secondary">AI</span>
                      </div>
                      <p class="caption text-theme-text-secondary text-nowrap">19 Feb 2024</p>
                    </div>
                    <a href="#" class="group flex flex-row items-center gap-5 text-theme-text-primary hover:text-primary-500">
                      <div class="grow">
                        <h4 class="line-clamp-2 text-theme-text-primary hover:text-primary-500 group-hover:text-primary-500">Harnessing the Power of AI: Innovations in the Logistics Sector</h4>
                      </div>
                      <div class="shrink-0">
                        <i class="ti ti-arrow-up-right text-[40px] leading-none"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="bg-[url('../images/blog/blog2.jpg')] relative h-[464px] rounded-3xl sm:rounded-[32px] md:rounded-[40px] w-full bg-cover bg-center">
                  <div class="-bottom-[2%] left-0 mb-1 p-6 absolute w-full z-10 select-none bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
                  <div class="flex flex-col gap-3">
                    <div class="flex flex-row justify-between items-center flex-wrap gap-2">
                      <div class="flex flex-row gap-2">
                        <span class="bg-neutral-300 px-4 py-2 rounded-full caption text-theme-text-secondary">Trade</span>
                        <span class="bg-neutral-300 px-4 py-2 rounded-full caption text-theme-text-secondary">Market</span>
                      </div>
                      <p class="caption text-theme-text-secondary text-nowrap">26 Feb 2024</p>
                    </div>
                    <a href="#" class="group flex flex-row items-center gap-5 text-theme-text-primary hover:text-primary-500">
                      <div class="grow">
                        <h4 class="line-clamp-2 text-theme-text-primary hover:text-primary-500 group-hover:text-primary-500">Global Trade Dynamics: Exploring New Markets and Opportunities</h4>
                      </div>
                      <div class="shrink-0">
                        <i class="ti ti-arrow-up-right text-[40px] leading-none"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="animate-y flex flex-col items-center justify-center gap-3 text-center">
            <h6 class="text-theme-text-secondary max-w-[75%] sm:max-w-[45%]">Explore the latest trends, tips, and best practices in HR and workforce management.</h6>
            <button class="btn btn-outline-primary btn-lg capitalize">
              Explore All Blog
            </button>
          </div>
        </div>
      </div>
    </section>
    <script src="../assets/js/plugins/tiny-slider.js"></script>
    <script type="module">
      document.addEventListener('DOMContentLoaded', function () {
        var slider = tns({
          container: '.blog-slider4',
          items: 1,
          center:false,
          nav: false,
          autoHeight: false,
          speed: 500,
          gutter: 4,
          autoplayTimeout: 6000,
          slideBy: 1,
          loop: true,
          controls: false,
          autoplay: true,
          autoplayButtonOutput: false,
          autoplayButton: false,
          edgePadding:20,
          mouseDrag:true,
          responsive: {
            575: {
              items: 1,
              gutter: 8,
              edgePadding:100,
            },
            768:{
              items: 1,
              gutter: 12,
              edgePadding:100,
            },
            1000:{
              items: 2,
              gutter: 12,
            },
            1266:{
              edgePadding:280,
            }
          }
        });
      });
    </script>
    <!-- [ Blog ] end -->
    <!-- [ Footer ] start -->
    <section class="common-section">
      <div class="container">
        <div class="animate-y delay-reset bg-neutral-100 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
          <div class="bg-neutral-200 rounded-3xl sm:rounded-[32px] md:rounded-[40px]">
            <div class="p-5 sm:p-6 lg:p-8">
              <div class="flex flex-col lg:flex-row gap-4 lg:items-center justify-between">
                <div class="flex flex-col gap-1 w-full md:w-[60%] max-lg:mx-auto max-lg:text-center">
                  <h3>Join our newsletter</h3>
                  <p class="body1 text-theme-textsecondary">Discover the features that will transform your customer relationships</p>
                </div>
                <div class="relative w-full lg:w-[400px]">
                  <button class="btn btn-primary absolute top-1 ltr:right-1 rtl:left-1 py-[15px] px-[23px] leading-none">
                    <i class="ti ti-send text-[16px] leading-none w-4 h-4 inline-block"></i>
                  </button>
                  <input type="search" class="form-control py-[15.2px] ltr:pl-6 rtl:pr-6 ltr:pr-16 rtl:pl-16 rounded-full bg-neutral-200" placeholder="Enter your email address" />
                </div>
              </div>
            </div>
          </div>
          <div class="p-5 sm:p-6 lg:p-8">
            <div class="flex flex-col gap-4 sm:gap-6 lg:gap-8">
              <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 lg:gap-8">
                <div class="basis-full lg:basis-6/12">
                  <div class="flex flex-col items-center lg:items-start justify-between gap-8 h-full pb-5 lg:pb-0">
                    <div class="flex flex-col gap-3 items-center lg:items-start max-lg:text-center">
                      <!-- [ Logo main ] start -->
                      <svg class="w-[112px] lg:w-[140px] h-auto text-primary-500" viewBox="0 0 140 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fillRule="evenodd"
                          clipRule="evenodd"
                          d="M18.8829 0.427107C21.4241 -0.961272 24.4323 1.23978 23.8814 4.08446L20.2026 23.083C20.1771 23.2543 20.1385 23.4244 20.0865 23.5919C19.9716 23.983 19.8053 24.3088 19.5985 24.5713L19.5803 24.5963C18.4651 26.1231 16.3244 26.456 14.7989 25.3398C14.0423 24.7862 13.5792 23.9802 13.4405 23.1221L13.4413 23.1226C13.018 21.5306 13.6228 17.2572 16.7968 10.4168L18.0197 11.7888L19.6391 5.17618C19.7118 4.87928 19.3889 4.64305 19.1283 4.80246L13.3241 8.35306L15.0704 9.15363C11.7777 12.6269 7.19306 15.8763 3.94258 16.2187C3.13058 16.3043 2.15871 16.0911 1.40248 15.5377C-0.123006 14.4215 -0.455588 12.279 0.659645 10.7522L0.66829 10.7404L0.678147 10.7271C0.865156 10.4504 1.1246 10.1932 1.46169 9.96519C1.60563 9.86452 1.75619 9.77586 1.91185 9.69943L18.8829 0.427107ZM6.39334 23.161C7.37266 23.8631 8.73948 23.6318 9.44623 22.6444C9.91583 21.9883 10.2609 19.8511 10.4396 18.4907C10.5082 17.9682 9.98185 17.5908 9.50966 17.8239C8.28019 18.431 6.36939 19.4456 5.8998 20.1017C5.19305 21.0891 5.41402 22.4588 6.39334 23.161Z"
                          fill="currentColor"
                        />
                        <path
                          d="M38.1793 21.288C37.2193 21.288 36.3073 21.192 35.4433 21C34.5793 20.808 33.8113 20.504 33.1393 20.088C32.4833 19.656 31.9633 19.12 31.5793 18.48C31.2113 17.824 31.0273 17.032 31.0273 16.104C31.0273 16.024 31.0273 15.944 31.0273 15.864C31.0273 15.768 31.0353 15.696 31.0513 15.648H34.6033C34.5873 15.696 34.5793 15.76 34.5793 15.84C34.5793 15.92 34.5793 15.992 34.5793 16.056C34.5793 16.568 34.7153 17 34.9873 17.352C35.2753 17.704 35.6913 17.968 36.2353 18.144C36.7793 18.32 37.4113 18.408 38.1313 18.408C38.5953 18.408 39.0033 18.384 39.3553 18.336C39.7233 18.272 40.0433 18.192 40.3153 18.096C40.6033 17.984 40.8353 17.856 41.0113 17.712C41.2033 17.568 41.3393 17.4 41.4193 17.208C41.5153 17.016 41.5633 16.8 41.5633 16.56C41.5633 16.128 41.4193 15.776 41.1313 15.504C40.8593 15.232 40.4753 15 39.9793 14.808C39.4993 14.616 38.9553 14.44 38.3473 14.28C37.7393 14.12 37.1153 13.96 36.4753 13.8C35.8353 13.624 35.2113 13.416 34.6033 13.176C33.9953 12.92 33.4513 12.616 32.9713 12.264C32.4913 11.912 32.1073 11.464 31.8193 10.92C31.5313 10.376 31.3873 9.72 31.3873 8.952C31.3873 8.136 31.5553 7.432 31.8913 6.84C32.2433 6.248 32.7313 5.76 33.3553 5.376C33.9793 4.992 34.6993 4.712 35.5153 4.536C36.3313 4.344 37.2193 4.248 38.1793 4.248C39.0753 4.248 39.9233 4.344 40.7233 4.536C41.5233 4.712 42.2273 5 42.8353 5.4C43.4433 5.8 43.9153 6.304 44.2513 6.912C44.6033 7.52 44.7793 8.24 44.7793 9.072V9.36H41.2993V9.168C41.2993 8.736 41.1713 8.368 40.9153 8.064C40.6593 7.76 40.2993 7.52 39.8353 7.344C39.3713 7.168 38.8273 7.08 38.2033 7.08C37.5313 7.08 36.9553 7.144 36.4753 7.272C36.0113 7.4 35.6513 7.592 35.3953 7.848C35.1553 8.088 35.0353 8.376 35.0353 8.712C35.0353 9.096 35.1713 9.416 35.4433 9.672C35.7313 9.912 36.1153 10.128 36.5953 10.32C37.0913 10.496 37.6433 10.656 38.2513 10.8C38.8593 10.944 39.4833 11.104 40.1233 11.28C40.7633 11.456 41.3873 11.664 41.9953 11.904C42.6033 12.144 43.1473 12.448 43.6273 12.816C44.1073 13.168 44.4913 13.608 44.7793 14.136C45.0673 14.664 45.2113 15.296 45.2113 16.032C45.2113 17.296 44.9073 18.312 44.2993 19.08C43.6913 19.848 42.8593 20.408 41.8033 20.76C40.7473 21.112 39.5393 21.288 38.1793 21.288ZM51.1083 21.288C50.6923 21.288 50.2443 21.24 49.7643 21.144C49.3003 21.048 48.8603 20.88 48.4443 20.64C48.0283 20.384 47.6843 20.024 47.4123 19.56C47.1563 19.08 47.0283 18.472 47.0283 17.736C47.0283 16.856 47.2203 16.128 47.6043 15.552C47.9883 14.976 48.5323 14.528 49.2363 14.208C49.9563 13.872 50.8123 13.64 51.8043 13.512C52.7963 13.384 53.8923 13.32 55.0923 13.32V12.384C55.0923 12.016 55.0283 11.696 54.9003 11.424C54.7883 11.152 54.5803 10.936 54.2763 10.776C53.9883 10.616 53.5803 10.536 53.0523 10.536C52.5243 10.536 52.0923 10.6 51.7563 10.728C51.4363 10.856 51.2043 11.024 51.0603 11.232C50.9323 11.424 50.8683 11.64 50.8683 11.88V12.168H47.6283C47.6123 12.088 47.6043 12.016 47.6043 11.952C47.6043 11.872 47.6043 11.776 47.6043 11.664C47.6043 10.928 47.8283 10.296 48.2763 9.768C48.7243 9.224 49.3563 8.808 50.1723 8.52C50.9883 8.232 51.9403 8.088 53.0283 8.088C54.1963 8.088 55.1723 8.24 55.9563 8.544C56.7563 8.848 57.3643 9.296 57.7803 9.888C58.2123 10.48 58.4283 11.224 58.4283 12.12V17.856C58.4283 18.144 58.5083 18.36 58.6683 18.504C58.8443 18.632 59.0363 18.696 59.2443 18.696H60.0363V20.88C59.8763 20.96 59.6283 21.04 59.2923 21.12C58.9563 21.216 58.5483 21.264 58.0683 21.264C57.6043 21.264 57.1883 21.192 56.8203 21.048C56.4683 20.92 56.1723 20.736 55.9323 20.496C55.6923 20.24 55.5243 19.936 55.4283 19.584H55.2603C54.9883 19.92 54.6523 20.216 54.2523 20.472C53.8683 20.728 53.4123 20.928 52.8843 21.072C52.3723 21.216 51.7803 21.288 51.1083 21.288ZM52.2363 18.768C52.6843 18.768 53.0843 18.704 53.4363 18.576C53.7883 18.432 54.0843 18.248 54.3243 18.024C54.5643 17.784 54.7483 17.496 54.8763 17.16C55.0203 16.824 55.0923 16.464 55.0923 16.08V15.384C54.1963 15.384 53.3963 15.448 52.6923 15.576C51.9883 15.688 51.4283 15.888 51.0123 16.176C50.6123 16.464 50.4123 16.864 50.4123 17.376C50.4123 17.664 50.4843 17.912 50.6283 18.12C50.7723 18.328 50.9803 18.488 51.2523 18.6C51.5243 18.712 51.8523 18.768 52.2363 18.768ZM65.0302 21.288C64.6142 21.288 64.1662 21.24 63.6862 21.144C63.2222 21.048 62.7822 20.88 62.3662 20.64C61.9502 20.384 61.6062 20.024 61.3342 19.56C61.0782 19.08 60.9502 18.472 60.9502 17.736C60.9502 16.856 61.1422 16.128 61.5262 15.552C61.9102 14.976 62.4542 14.528 63.1582 14.208C63.8782 13.872 64.7342 13.64 65.7262 13.512C66.7182 13.384 67.8142 13.32 69.0142 13.32V12.384C69.0142 12.016 68.9502 11.696 68.8222 11.424C68.7102 11.152 68.5022 10.936 68.1982 10.776C67.9102 10.616 67.5022 10.536 66.9742 10.536C66.4462 10.536 66.0142 10.6 65.6782 10.728C65.3582 10.856 65.1262 11.024 64.9822 11.232C64.8542 11.424 64.7902 11.64 64.7902 11.88V12.168H61.5502C61.5342 12.088 61.5262 12.016 61.5262 11.952C61.5262 11.872 61.5262 11.776 61.5262 11.664C61.5262 10.928 61.7502 10.296 62.1982 9.768C62.6462 9.224 63.2782 8.808 64.0942 8.52C64.9102 8.232 65.8622 8.088 66.9502 8.088C68.1182 8.088 69.0942 8.24 69.8782 8.544C70.6782 8.848 71.2862 9.296 71.7022 9.888C72.1342 10.48 72.3502 11.224 72.3502 12.12V17.856C72.3502 18.144 72.4302 18.36 72.5902 18.504C72.7662 18.632 72.9582 18.696 73.1662 18.696H73.9582V20.88C73.7982 20.96 73.5502 21.04 73.2142 21.12C72.8782 21.216 72.4702 21.264 71.9902 21.264C71.5262 21.264 71.1102 21.192 70.7422 21.048C70.3902 20.92 70.0942 20.736 69.8542 20.496C69.6142 20.24 69.4462 19.936 69.3502 19.584H69.1822C68.9102 19.92 68.5742 20.216 68.1742 20.472C67.7902 20.728 67.3342 20.928 66.8062 21.072C66.2942 21.216 65.7022 21.288 65.0302 21.288ZM66.1582 18.768C66.6062 18.768 67.0062 18.704 67.3582 18.576C67.7102 18.432 68.0062 18.248 68.2462 18.024C68.4862 17.784 68.6702 17.496 68.7982 17.16C68.9422 16.824 69.0142 16.464 69.0142 16.08V15.384C68.1182 15.384 67.3182 15.448 66.6142 15.576C65.9102 15.688 65.3502 15.888 64.9342 16.176C64.5342 16.464 64.3342 16.864 64.3342 17.376C64.3342 17.664 64.4062 17.912 64.5502 18.12C64.6942 18.328 64.9022 18.488 65.1742 18.6C65.4462 18.712 65.7742 18.768 66.1582 18.768ZM80.7281 21.288C79.8481 21.288 79.0561 21.192 78.3521 21C77.6481 20.808 77.0481 20.544 76.5521 20.208C76.0561 19.856 75.6721 19.44 75.4001 18.96C75.1441 18.48 75.0161 17.936 75.0161 17.328C75.0161 17.264 75.0161 17.2 75.0161 17.136C75.0161 17.072 75.0241 17.024 75.0401 16.992H78.2561C78.2561 17.024 78.2561 17.056 78.2561 17.088C78.2561 17.12 78.2561 17.152 78.2561 17.184C78.2721 17.584 78.4001 17.912 78.6401 18.168C78.8801 18.408 79.1921 18.584 79.5761 18.696C79.9761 18.808 80.3921 18.864 80.8241 18.864C81.2081 18.864 81.5761 18.832 81.9281 18.768C82.2961 18.688 82.6001 18.552 82.8401 18.36C83.0961 18.168 83.2241 17.92 83.2241 17.616C83.2241 17.232 83.0641 16.936 82.7441 16.728C82.4401 16.52 82.0321 16.352 81.5201 16.224C81.0241 16.096 80.4801 15.952 79.8881 15.792C79.3441 15.664 78.8001 15.52 78.2561 15.36C77.7121 15.184 77.2161 14.96 76.7681 14.688C76.3361 14.416 75.9841 14.064 75.7121 13.632C75.4401 13.184 75.3041 12.624 75.3041 11.952C75.3041 11.296 75.4481 10.728 75.7361 10.248C76.0241 9.752 76.4161 9.344 76.9121 9.024C77.4241 8.704 78.0161 8.472 78.6881 8.328C79.3761 8.168 80.1121 8.088 80.8961 8.088C81.6321 8.088 82.3201 8.168 82.9601 8.328C83.6001 8.472 84.1601 8.696 84.6401 9C85.1201 9.288 85.4961 9.656 85.7681 10.104C86.0401 10.536 86.1761 11.024 86.1761 11.568C86.1761 11.68 86.1761 11.784 86.1761 11.88C86.1761 11.976 86.1681 12.04 86.1521 12.072H82.9601V11.88C82.9601 11.592 82.8721 11.352 82.6961 11.16C82.5201 10.952 82.2641 10.792 81.9281 10.68C81.6081 10.568 81.2161 10.512 80.7521 10.512C80.4321 10.512 80.1361 10.536 79.8641 10.584C79.6081 10.632 79.3841 10.704 79.1921 10.8C79.0001 10.896 78.8481 11.016 78.7361 11.16C78.6401 11.288 78.5921 11.448 78.5921 11.64C78.5921 11.912 78.7041 12.136 78.9281 12.312C79.1681 12.472 79.4801 12.608 79.8641 12.72C80.2481 12.832 80.6721 12.952 81.1361 13.08C81.7121 13.24 82.3121 13.4 82.9361 13.56C83.5761 13.704 84.1681 13.904 84.7121 14.16C85.2561 14.416 85.6961 14.784 86.0321 15.264C86.3681 15.728 86.5361 16.36 86.5361 17.16C86.5361 17.928 86.3841 18.576 86.0801 19.104C85.7921 19.632 85.3841 20.056 84.8561 20.376C84.3281 20.696 83.7121 20.928 83.0081 21.072C82.3041 21.216 81.5441 21.288 80.7281 21.288ZM87.56 21L93.896 4.536H98.312L104.648 21H100.784L99.608 17.76H92.432L91.256 21H87.56ZM93.464 14.88H98.576L97.112 10.824C97.048 10.648 96.968 10.44 96.872 10.2C96.792 9.944 96.704 9.664 96.608 9.36C96.512 9.056 96.416 8.76 96.32 8.472C96.24 8.168 96.16 7.896 96.08 7.656H95.936C95.856 7.96 95.752 8.32 95.624 8.736C95.496 9.136 95.368 9.528 95.24 9.912C95.112 10.28 95.008 10.584 94.928 10.824L93.464 14.88ZM113.375 21.288C112.559 21.288 111.807 21.128 111.119 20.808C110.447 20.472 109.903 19.968 109.487 19.296H109.319L109.055 21H106.319V3.648H109.655V9.768H109.799C110.055 9.4 110.367 9.088 110.735 8.832C111.103 8.576 111.519 8.392 111.983 8.28C112.447 8.152 112.951 8.088 113.495 8.088C114.487 8.088 115.351 8.32 116.087 8.784C116.839 9.248 117.423 9.968 117.839 10.944C118.255 11.904 118.463 13.144 118.463 14.664C118.463 16.184 118.255 17.432 117.839 18.408C117.439 19.384 116.855 20.112 116.087 20.592C115.335 21.056 114.431 21.288 113.375 21.288ZM112.343 18.552C113.015 18.552 113.543 18.424 113.927 18.168C114.327 17.896 114.615 17.496 114.791 16.968C114.967 16.44 115.055 15.776 115.055 14.976V14.424C115.055 13.624 114.967 12.96 114.791 12.432C114.615 11.888 114.327 11.488 113.927 11.232C113.543 10.96 113.015 10.824 112.343 10.824C111.863 10.824 111.455 10.912 111.119 11.088C110.783 11.248 110.503 11.488 110.279 11.808C110.071 12.112 109.911 12.496 109.799 12.96C109.687 13.424 109.631 13.936 109.631 14.496V14.928C109.631 15.68 109.727 16.328 109.919 16.872C110.111 17.416 110.407 17.832 110.807 18.12C111.207 18.408 111.719 18.552 112.343 18.552ZM120.921 21V3.648H124.257V21H120.921ZM133.055 21.288C131.663 21.288 130.495 21.056 129.551 20.592C128.607 20.112 127.895 19.384 127.415 18.408C126.935 17.432 126.695 16.192 126.695 14.688C126.695 13.168 126.935 11.928 127.415 10.968C127.895 9.992 128.599 9.272 129.527 8.808C130.471 8.328 131.623 8.088 132.983 8.088C134.263 8.088 135.343 8.32 136.223 8.784C137.103 9.232 137.767 9.936 138.215 10.896C138.663 11.84 138.887 13.064 138.887 14.568V15.432H130.079C130.111 16.168 130.223 16.792 130.415 17.304C130.623 17.816 130.935 18.2 131.351 18.456C131.783 18.696 132.351 18.816 133.055 18.816C133.439 18.816 133.783 18.768 134.087 18.672C134.407 18.576 134.679 18.432 134.903 18.24C135.127 18.048 135.303 17.808 135.431 17.52C135.559 17.232 135.623 16.904 135.623 16.536H138.887C138.887 17.336 138.743 18.032 138.455 18.624C138.167 19.216 137.767 19.712 137.255 20.112C136.743 20.496 136.127 20.792 135.407 21C134.703 21.192 133.919 21.288 133.055 21.288ZM130.127 13.32H135.455C135.455 12.84 135.391 12.424 135.263 12.072C135.151 11.72 134.991 11.432 134.783 11.208C134.575 10.984 134.319 10.824 134.015 10.728C133.727 10.616 133.399 10.56 133.031 10.56C132.423 10.56 131.911 10.664 131.495 10.872C131.095 11.064 130.783 11.368 130.559 11.784C130.351 12.184 130.207 12.696 130.127 13.32Z"
                          fill="currentColor"
                        />
                      </svg>
                      <p class="body2 max-w-[280px]">Empower your HR team with our comprehensive platform for seamless HR management</p>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-outline-primary dropdown-toggle arrow-none w-full" type="button"
                        data-pc-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ENG
                        <i class="ti ti-chevron-down"></i>
                      </button>
                      <div class="dropdown-menu dropdown-center overflow-hidden border border-neutral-200">
                        <a class="dropdown-item subtitle1 active" href="#!">English (UK)</a>
                        <a class="dropdown-item subtitle1" href="#!">Arabic (عربي)</a>
                        <a class="dropdown-item subtitle1" href="#!">Chinese (中国人)</a>
                        <a class="dropdown-item subtitle1" href="#!">French (français)</a>
                      </div>
                    </div>
                    <div class="flex flex-col gap-4 max-md:text-center">
                      <h4>Follow Us on</h4>
                      <div class="flex flex-row flex-wrap gap-1 text-2xl leading-none *:flex *:items-center *:justify-center sm:gap-3 *:w-10 sm:*:w-[52px] md:*:w-14 *:h-10 sm:*:h-[52px] md:*:h-14 *:rounded-xl *:text-primary-500 *:bg-neutral-200 *:hover:bg-neutral-300 *:transition-all *:duration-500">
                        <a href="https://in.linkedin.com/company/phoenixcoded" target="_blank"><i class="ti ti-brand-linkedin"></i></a>
                        <a href="https://www.facebook.com/Phoenixcoded/" target="_blank"><i class="ti ti-brand-facebook-filled"></i></a>
                        <a href="https://www.youtube.com/@Phoenixcoded" target="_blank"><i class="ti ti-brand-youtube-filled"></i></a>
                        <a href="https://github.com/phoenixcoded" target="_blank"><i class="ti ti-brand-github-filled"></i></a>
                        <a href="https://dribbble.com/Phoenixcoded" target="_blank"><i class="ti ti-brand-dribbble-filled"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="basis-full lg:basis-6/12">
                  <div class="flex flex-row flex-wrap justify-between gap-5 md:gap-8">
                    <div class="basis-full sm:basis-auto">
                      <div class="flex flex-col md:gap-6 items-start">
                        <h4>Use Case</h4>
                        <ul class="*:*:min-h-9 sm:*:*:min-h-10 *:*:py-1.5 *:*:flex *:*:items-center max-sm:caption2 caption1 py-2 *:*:text-neutral-800 *:*:hover:text-primary-500 *:*:transition-all *:*:duration-500">
                          <li><a href="#">Business Analytics</a></li>
                          <li><a href="#">Marketing Automation</a></li>
                          <li><a href="#">Collaboration Suites</a></li>
                          <li><a href="#">Project Management</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="basis-5/12 sm:basis-auto">
                      <div class="flex flex-col md:gap-6 items-start">
                        <h4>Support</h4>
                        <ul class="*:*:min-h-9 sm:*:*:min-h-10 *:*:py-1.5 *:*:flex *:*:items-center max-sm:caption2 caption1 py-2 *:*:text-neutral-800 *:*:hover:text-primary-500 *:*:transition-all *:*:duration-500">
                          <li><a href="../pages/pricing.html" target="_blank">Pricing</a></li>
                          <li><a href="../pages/faq.html" target="_blank">FAQ</a></li>
                          <li><a href="https://phoenixcoded.authordesk.app/" target="_blank">Support</a></li>
                          <li><a href="https://themeforest.net/licenses/standard" target="_blank">License Terms</a></li>
                          <li><a href="https://discord.gg/gmqz4BWYA8" target="_blank">Discord</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="basis-6/12 sm:basis-auto">
                      <div class="flex flex-col md:gap-6 items-start">
                        <h4>Company</h4>
                        <ul class="*:*:min-h-9 sm:*:*:min-h-10 *:*:py-1.5 *:*:flex *:*:items-center max-sm:caption2 caption1 py-2 *:*:text-neutral-800 *:*:hover:text-primary-500 *:*:transition-all *:*:duration-500">
                          <li><a target="_blank" href="https://blog.saasable.io/a-decade-of-expertise-the-phoenixcoded-story-and-why-you-should-trust-us">Why Phoenixcoded?</a></li>
                          <li><a target="_blank" href="../pages/about.html">About</a></li>
                          <li><a target="_blank" href="../pages/contact.html">Contact Us</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="border-theme-divider">
              <div class="flex flex-col sm:flex-row items-center caption justify-center gap-3 text-neutral-800">
                <span class="caption2">Copyright © 2025 <a href="https://phoenixcoded.net" class="caption hover:text-primary-500 hover:underline">Phoenixcoded</a></span>
                <div class="border-t sm:border-t-0 sm:border-l border-theme-divider self-stretch h-auto"></div>
                <div class="flex flex-col sm:flex-row items-center caption justify-center md:justify-end gap-3 text-neutral-800">
                  <a href="../pages/privacy-policy.html" class="hover:text-primary-500 hover:underline">Privacy Policy</a>
                  <div class="border-t sm:border-t-0 sm:border-l border-theme-divider self-stretch h-auto"></div>
                  <a href="https://themeforest.net/licenses/standard" class="hover:text-primary-500 hover:underline">Terms & Conditions</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- [ Footer ] end -->
    
    <div class="floting-button fixed bottom-[20px] ltr:right-[20px] rtl::left-[20px] md:bottom-[40px] ltr:md:right-[40px] rtl:md:left-[40px] z-[1030] group scroll-top">
      <a href="#" class="btn btn-primary flex items-center justify-center p-0 w-[40px] h-[40px] lg:w-[52px] lg:h-[52px] rounded-full gap-2 opacity-0 translate-y-5 group-[.scroll-show]:opacity-100 group-[.scroll-show]:translate-y-0 duration-500 delay-300 shadow-[rgba(0,_0,_0,_0.2)_0px_3px_5px_-1px,_rgba(0,_0,_0,_0.14)_0px_6px_10px_0px,_rgba(0,_0,_0,_0.12)_0px_1px]">
        <i class="ti ti-arrow-up text-2xl leading-none text-theme-bodybg"></i>
      </a>
    </div>
    <!-- Required Js -->
    <script src="../assets/js/plugins/popper.min.js"></script>
    <script src="../assets/js/icon/custom-font.js"></script>
    <script src="../assets/js/component.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/theme.js"></script>

    
    <script>
      layout_change('false');
    </script>
     
    
    <script>
      layout_rtl_change('false');
    </script>
    

    <script src="../assets/js/plugins/motion.js"></script>
    <script type="module">
      const { animate, inView, scroll } = Motion;
      window.addEventListener('load', function () {
        // main hero
        var element = document.querySelector('.img-hero-1');
        var ref = document.querySelector('.animation-ref');
        scroll(animate(element, { scale: [0.9, 0.92, 0.94, 0.96, 1] }), {
          target: ref,
          offset: ['start start', 'end start'],
        });
        
        // translate y 
        var anim = document.querySelectorAll('.animate-y');
        var sec = 0;
        inView(anim, (element) => {
          if(element.classList.contains("delay-reset")){
            sec = 0
          }else{
            sec += 0.1;
          }
          animate(
            element,
            { opacity: [0,1], y: [50, 0] },
            {
              duration: 1,
              delay: sec,
              ease: [0.215, 0.61, 0.355, 1]
            }
          )
        })

        var anim = document.querySelector('.animate-y-down');
        inView(anim, (element) => {
          if(element.classList.contains("delay-reset")){
            sec = 0
          }else{
            sec += 0.1;
          }
          animate(
            element,
            { opacity: [0,1], y: [-50, 0] },
            {
              duration: 1,
              delay: 0.4,
              ease: [0.215, 0.61, 0.355, 1]
            }
          )
        })
    
      });
    </script>
  </body>
</html>
