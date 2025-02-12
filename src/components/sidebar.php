<style>
   .rotate-90 {
      transform: rotate(90deg);
      transition: transform 0.3s;
   }
</style>

<nav
   class="backdrop-blur-[10px] backdrop-saturate-[200%] bg-[rgba(255,255,255,0.2)] border rounded-none border-solid border-[rgba(216,216,216,0.13)] -webkit-backdrop-filter: blur(10px) saturate(200%) fixed top-0 z-40 w-full dark:backdrop-blur-[10px] dark:backdrop-saturate-[200%] dark:bg-[rgba(0,0,0,0.2)] dark:border-solid dark:border-[rgba(0, 0, 0, 0.13)] sm:hidden">
   <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
         <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
               type="button"
               class="inline-flex items-center p-2 text-sm text-gray-500 hover:shadow-lg hover:shadow-blue-500/50 rounded-lg sm:hidden focus:outline-none focus:ring-2 focus:ring-blue-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
               <span class="sr-only">Abrir sidebar</span>
               <svg class="w-6 h-6 text-blue-700" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path clip-rule="evenodd" fill-rule="evenodd"
                     d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                  </path>
               </svg>
            </button>
            <a href="../web/dashboard" class="flex justify-center items-center w-full">
               <img src="../../assets/img/logoMercurio-sb.png" class="h-14 ms-6" alt="Mercurio Logo">
               <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"></span>
            </a>
         </div>
      </div>
   </div>
</nav>

<aside id="logo-sidebar"
   class="flex flex-col shadow-2xl fixed top-0 left-0 z-40 w-64 h-screen pt-4 transition-transform -translate-x-full bg-blue-600 border-r border-blue-500 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
   aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-600 dark:bg-gray-800">
      <a href="dashboard" class="flex items-center ps-2.5 mb-5">
         <svg width="80" height="80" viewBox="0 0 1774 1455" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
               d="M725.467 4.26672C728.134 16.6667 731.467 24.8 741.601 44.4C747.734 56.4 752.534 66.5333 752.134 66.9333C751.734 67.3333 746.134 63.4667 739.734 58.4C733.334 53.2 726.667 48.4 725.067 47.4667C721.334 45.6 712.401 45.6 708.001 47.6C704.667 49.0667 704.667 49.2 705.467 59.8667C707.067 80.1334 711.601 92.8001 724.001 112.533C726.534 116.533 728.401 120 728.134 120.267C728.001 120.533 723.467 118.933 718.267 116.8C709.201 113.067 708.801 112.933 706.667 115.333C704.534 117.6 704.534 118.8 706.401 131.6C710.801 160.533 720.401 182.8 744.001 218C752.667 230.8 761.734 245.733 764.267 251.067C777.067 278.533 777.334 304.933 764.934 338.667C755.201 365.067 742.001 390.933 724.934 417.333C720.134 424.667 714.534 434.8 712.401 440C706.801 453.6 703.467 458.8 683.334 486C624.801 564.933 602.667 612.267 590.801 683.467C584.401 721.6 577.467 739.333 563.601 753.333C553.867 763.2 545.467 767.867 528.801 772.8C492.401 783.6 480.934 785.2 422.001 787.867C271.334 794.667 268.134 794.933 253.334 800C247.467 802 242.267 804 241.734 804.533C240.134 806 245.601 819.333 249.467 823.467C256.401 830.8 276.267 839.2 294.401 842.667C300.667 843.733 321.201 845.2 342.001 846C417.467 848.8 445.467 853.2 499.334 870.667C537.867 883.2 592.267 897.2 625.334 903.2C659.201 909.2 676.001 910.667 714.667 910.667C747.334 910.667 754.001 910.267 768.001 907.733C804.401 901.067 823.467 893.067 849.601 873.2C868.267 859.067 883.067 850.8 899.334 845.6C916.934 839.867 927.334 838.667 957.334 838.8C989.867 838.8 996.401 840 1020.13 849.467C1032.8 854.4 1038.13 855.867 1046.4 856.4L1056.67 857.067L1073.5 845.6L1056.67 828.8L1052.4 825.6C1045.47 820.4 1040.8 818.4 1023.2 813.333C987.067 802.8 971.334 794 950.667 773.2C932.134 754.4 922.001 750.267 886.534 747.333C876.401 746.533 865.467 745.467 862.267 745.2L856.534 744.533L856.801 719.6C857.067 689.867 859.334 667.2 864.667 639.6C876.534 579.867 897.867 534.133 936.534 486C952.801 465.733 960.934 452.4 966.801 436.8C977.601 408.133 977.867 382.667 968.534 304C958.534 220.4 933.734 154.133 892.934 103.067C886.267 94.6667 884.001 92.8 880.534 92.4C876.801 92 876.001 91.2 874.267 86.4C872.134 79.7334 867.201 75.0667 842.667 56.6667C799.067 24 766.934 7.0667 738.801 2.13336C725.867 -0.266638 724.534 5.67436e-05 725.467 4.26672Z"
               fill="white" />
            <path
               d="M625.067 123.467C546.934 128.4 469.334 147.067 398.667 178C380.801 185.867 364.134 194 364.801 194.533C365.067 194.8 375.467 199.2 387.867 204.533L410.534 214.133L426.267 206.667C496.534 173.467 574.401 152 649.334 145.333C690.134 141.6 687.467 142 686.801 139.6C686.401 138.4 685.734 133.867 685.201 129.6L684.401 122L662.801 122.133C651.067 122.267 634.001 122.8 625.067 123.467Z"
               fill="white" />
            <path
               d="M55.7337 134.8C60.2671 143.867 72.6671 154.933 88.4004 164.133C88.6671 164.267 87.0671 168 84.8004 172.4L80.8004 180.4L90.4004 189.6C122.667 220.8 164.134 245.067 248.667 282.667C317.867 313.333 356.267 337.467 390 371.333C427.6 408.933 452.934 452.533 476 519.2C497.067 580.533 510.8 645.333 518.667 721.733C519.867 733.067 521.734 744.533 522.8 747.333L524.934 752.533L530.4 750.533C554 742.133 562.8 726.4 570.667 678.133C582.534 606 608.8 550.667 668.8 471.2C682.934 452.667 691.2 439.067 695.2 428.533C696.4 425.333 695.467 424.133 682.934 411.733C646.667 376.133 605.6 346.267 529.2 300.4C471.2 265.333 437.867 248.267 380.667 223.733C328.4 201.333 227.334 164 148.534 138.133C123.467 130 116.534 128.8 108.8 131.467C105.467 132.667 104.667 133.6 104.667 136.8C104.667 138.933 104.534 140.667 104.267 140.667C104 140.667 96.9337 138.267 88.5337 135.2C77.7337 131.333 70.4004 129.6 62.9337 129.067L52.4004 128.267L55.7337 134.8Z"
               fill="white" />
            <path
               d="M194 318.934C166.934 346.134 149.334 366.534 130.534 392C56.267 492.8 13.867 605.067 1.86699 732.667C-0.399675 755.6 -0.399675 821.467 1.86699 844C10.4003 934.134 32.9337 1014.13 70.1337 1087.33C83.7337 1114.13 91.067 1126.67 107.067 1151.33C147.467 1213.6 199.867 1270.4 258 1315.47C418 1439.33 624.4 1483.6 822.4 1436.4C831.867 1434.27 839.334 1432.27 839.067 1432C838.8 1431.73 831.067 1432.67 822 1434.13C776.267 1441.07 712.667 1443.87 669.334 1440.8C524 1430.13 393.734 1377.6 281.334 1284.13C261.2 1267.33 219.867 1226.13 203.2 1206C147.6 1139.2 108.4 1068.8 82.267 988.667C66.0003 939.067 56.667 890.667 52.5337 835.334C50.667 810.134 51.7337 748.267 54.5337 725.334C55.6003 716.534 56.9337 705.867 57.467 701.6L58.4003 694H276.134H494V690.267C494 686.667 491.334 668.8 488.534 652.934L487.067 644.667H277.867C162.8 644.667 68.667 644.267 68.667 643.867C68.667 642.8 73.7337 622.8 76.1337 614.267L78.1337 607.334H278.8C389.067 607.334 479.334 606.934 479.334 606.267C479.334 605.734 476.667 594.934 473.334 582.267C470 569.467 467.334 558.8 467.334 558.534C467.334 558.267 383.734 557.867 281.467 557.734L95.6003 557.334L101.6 543.334C104.8 535.6 108.4 527.334 109.467 524.934L111.334 520.667H282.667C393.334 520.667 454 520.267 454 519.334C454 517.467 448.267 502.4 441.067 485.734L434.934 471.334H286.534C204.8 471.334 138 471.067 138 470.534C138 470.134 142.534 462.534 148.134 453.6C176 409.2 212 364.8 248.934 329.467L266 312.934L247.734 304.667C237.6 300.134 227.334 295.467 224.8 294.4L220.134 292.4L194 318.934Z"
               fill="white" />
            <path
               d="M1038.27 1070C1024.8 1073.6 1015.07 1079.47 1004 1090.53C993.066 1101.47 984.933 1116.4 980.533 1133.33C976.933 1146.67 976.266 1178.67 979.2 1193.33C987.066 1232.8 1011.87 1258.8 1047.2 1264.67C1071.2 1268.67 1097.73 1260.8 1114.53 1244.93C1123.73 1236.13 1132.67 1220.27 1136.13 1206.67C1136.93 1203.33 1136.93 1203.33 1128.13 1203.33C1119.73 1203.33 1119.33 1203.47 1118.53 1206.93C1117.2 1212.53 1112.13 1222 1107.33 1228C1094.53 1244 1071.73 1252.4 1050.27 1248.67C1023.6 1244.27 1004.27 1224.67 996.666 1194.67C993.333 1181.47 992.933 1154.13 996 1140C1000.27 1120 1014.53 1099.2 1029.6 1091.07C1045.47 1082.53 1067.2 1080.93 1083.47 1087.33C1098.8 1093.33 1111.47 1106.27 1116.93 1121.6L1120 1130H1128.27C1132.93 1130 1136.67 1129.47 1136.67 1128.8C1136.67 1128.13 1135.47 1123.73 1134 1119.07C1126.67 1095.07 1103.07 1073.87 1078.27 1068.8C1067.47 1066.53 1049.33 1067.07 1038.27 1070Z"
               fill="white" />
            <path
               d="M1669.47 1069.47C1650.53 1074 1631.2 1088.67 1620.8 1106.27C1610.27 1124.27 1605.07 1149.2 1606.53 1174C1608.53 1209.73 1621.87 1236.8 1645.07 1252.27C1659.33 1261.87 1671.07 1265.33 1689.33 1265.2C1713.87 1265.2 1729.6 1258.8 1746.27 1242C1762.27 1225.87 1770 1207.47 1772.67 1179.73C1777.87 1124.53 1752.13 1079.33 1709.73 1069.33C1699.33 1066.93 1679.87 1066.93 1669.47 1069.47ZM1703.6 1084.8C1727.6 1089.87 1746 1109.47 1753.6 1138C1757.2 1151.6 1756.8 1183.33 1752.93 1197.33C1745.87 1222 1731.2 1238.93 1710.8 1246C1687.87 1253.87 1662.8 1248.27 1646.13 1231.73C1636.8 1222.4 1628.27 1205.87 1625.33 1191.6C1622.67 1178.8 1622.8 1154 1625.47 1140.93C1631.07 1113.47 1649.6 1091.73 1672.8 1085.47C1681.6 1083.07 1694.13 1082.8 1703.6 1084.8Z"
               fill="white" />
            <path
               d="M424.667 1166.67V1263.33H432.667H440.667V1184.4C440.667 1138.53 441.2 1106 441.867 1106.67C442.534 1107.47 457.6 1142.93 475.467 1185.6L507.734 1263.33H515.467C520.267 1263.33 523.334 1262.67 523.734 1261.6C525.467 1257.47 583.867 1117.87 586.267 1112.4C587.734 1108.93 589.467 1106.4 590.134 1106.8C590.8 1107.2 591.334 1141.87 591.334 1185.47V1263.33H599.334H607.334V1166.67V1070H597.067H586.667L551.867 1153.73C532 1201.6 516.4 1237.33 515.334 1237.33C514.4 1237.33 498.8 1201.47 478.934 1153.6L444 1070H434.4H424.667V1166.67Z"
               fill="white" />
            <path
               d="M659.334 1166.67V1263.33H716.001H772.667V1255.33V1247.33H724.134H675.601L675.467 1210.67L675.334 1174H720.001H764.667V1166.67C764.667 1161.73 764.134 1159.33 763.067 1159.2C762.134 1159.2 742.134 1159.07 718.667 1158.93L676.001 1158.67V1122V1085.33L723.734 1084.93L771.334 1084.67V1077.33V1070H715.334H659.334V1166.67Z"
               fill="white" />
            <path
               d="M816.934 1166.67V1263.33H825.467H834V1224V1184.67H860.667H887.2L890.534 1190.27C892.267 1193.47 901.734 1210.67 911.334 1228.67C920.934 1246.67 929.334 1261.87 929.867 1262.4C930.4 1262.93 935.2 1263.33 940.267 1263.07L949.6 1262.67L927.867 1222.67C915.867 1200.67 906 1182.4 906 1181.87C906 1181.47 909.067 1179.73 912.934 1177.87C933.334 1168.4 944.8 1144 940.934 1118C938.134 1098.27 928.267 1084.13 912.267 1076.67C899.867 1070.8 892.934 1070 853.334 1070H817.067L816.934 1166.67ZM898.934 1088C908 1091.07 915.867 1097.87 920.4 1106.53C923.6 1112.67 924 1114.67 924 1127.33C924 1140.4 923.734 1141.87 920 1148.67C917.734 1152.67 913.467 1157.87 910.267 1160.27C900.667 1167.6 894.4 1168.67 862.4 1168.67H834V1127.6C834 1104.93 834.4 1086 834.934 1085.47C835.6 1084.93 848.534 1084.67 864 1084.93C886.8 1085.47 893.334 1086 898.934 1088Z"
               fill="white" />
            <path
               d="M1179.33 1139.07C1179.33 1215.07 1179.47 1216.4 1187.6 1231.6C1190 1236 1195.2 1242.67 1199.73 1246.8C1214.13 1260.13 1230.13 1266 1252.27 1266C1287.2 1266 1312.8 1248.53 1322.8 1218C1324.93 1211.47 1325.2 1203.47 1325.73 1140.27L1326.13 1070H1317.47H1308.8L1308.4 1138.93C1307.87 1216 1307.87 1215.47 1298.53 1228.13C1288.4 1241.87 1275.33 1248.53 1256.67 1249.6C1230.93 1251.2 1211.6 1241.07 1201.73 1220.93L1197.33 1212L1196.93 1141.07L1196.53 1070H1188H1179.33V1139.07Z"
               fill="white" />
            <path
               d="M1378 1166.67V1263.33H1386H1394L1394.27 1224.27L1394.67 1185.33L1421.33 1185.07L1448 1184.67L1468 1222.13C1479.07 1242.8 1488.67 1260.53 1489.33 1261.6C1490.4 1262.93 1493.07 1263.33 1500.27 1263.07L1509.73 1262.67L1487.87 1222.67C1475.87 1200.67 1466 1182.27 1466 1181.87C1466 1181.47 1468.53 1179.87 1471.6 1178.53C1492 1169.33 1503.2 1148.67 1501.6 1123.33C1500.27 1101.73 1491.47 1086.93 1474.93 1077.87C1461.73 1070.8 1455.6 1070 1414.4 1070H1378V1166.67ZM1459.2 1087.87C1464.4 1089.6 1468.27 1092.13 1473.2 1097.07C1481.33 1105.33 1484.67 1114 1484.67 1127.2C1484.67 1145.33 1477.87 1157.2 1463.6 1164.27C1456 1168 1455.87 1168 1425.07 1168.4L1394 1168.93V1127.6C1394 1104.93 1394.4 1086 1395.07 1085.47C1395.6 1084.93 1408.67 1084.67 1424 1085.07C1445.73 1085.47 1453.6 1086.13 1459.2 1087.87Z"
               fill="white" />
            <path d="M1546 1166.67V1263.33H1554.67H1563.33V1166.67V1070H1554.67H1546V1166.67Z" fill="white" />
            <path
               d="M1012.8 1317.07C1014.93 1319.07 1015.33 1321.33 1015.33 1333.73C1015.33 1342.8 1014.67 1349.2 1013.6 1351.33L1011.87 1354.67L1022.53 1354.93C1033.73 1355.2 1037.07 1354.27 1039.2 1350.13C1040.53 1347.73 1040.4 1347.73 1035.73 1350.13C1032.93 1351.6 1028.13 1352.67 1025.07 1352.67H1019.33V1335.73C1019.33 1323.07 1019.87 1318.4 1021.2 1316.8C1022.93 1314.93 1022.4 1314.67 1016.67 1314.67C1010.4 1314.67 1010.27 1314.67 1012.8 1317.07Z"
               fill="white" />
            <path
               d="M1056 1321.6C1054 1325.87 1050.27 1334.13 1047.73 1340C1045.07 1345.87 1042.13 1351.73 1040.93 1352.93C1039.07 1355.2 1039.33 1355.33 1044.8 1355.33C1049.47 1355.2 1050.13 1354.93 1048.4 1353.87C1045.47 1352.13 1045.33 1350 1048.27 1344C1050.53 1339.2 1050.53 1339.2 1058.53 1339.6L1066.4 1340L1068.27 1345.33C1069.47 1348.8 1069.73 1351.33 1068.93 1352.8C1067.87 1354.53 1068.53 1354.8 1074.13 1354.8C1079.73 1354.8 1080.27 1354.67 1078 1353.07C1076.67 1352.13 1072.4 1343.33 1068.67 1333.6C1064.8 1324 1061.2 1315.47 1060.67 1314.93C1060.13 1314.27 1058 1317.33 1056 1321.6ZM1061.2 1326.4C1065.47 1336.8 1065.47 1336.67 1058.8 1336.67C1055.47 1336.67 1052.67 1336.13 1052.67 1335.47C1052.67 1333.87 1058 1322 1058.67 1322C1059.07 1322 1060.13 1324 1061.2 1326.4Z"
               fill="white" />
            <path
               d="M1084 1317.33C1087.2 1320.4 1087.33 1321.47 1087.33 1335.47C1087.33 1346.67 1086.8 1350.93 1085.47 1352.53C1083.73 1354.53 1084 1354.67 1088.93 1354.8C1093.73 1354.93 1094.13 1354.8 1092.27 1353.33C1090.27 1351.87 1090 1349.73 1090.27 1338.53L1090.67 1325.47L1104 1340.67L1117.33 1355.87L1117.73 1336.67C1117.87 1326.13 1118.67 1316.93 1119.2 1316.13C1120 1315.07 1118.53 1314.67 1114.4 1314.53C1108.4 1314.4 1108.4 1314.4 1111.87 1316.27C1115.33 1318 1115.33 1318.27 1115.33 1332C1115.33 1339.73 1115.2 1346 1114.93 1346C1114.67 1346 1108.13 1338.8 1100.53 1330C1090.8 1318.8 1085.73 1314 1083.73 1314C1080.8 1314 1080.8 1314 1084 1317.33Z"
               fill="white" />
            <path
               d="M1176.4 1315.73C1179.2 1317.07 1179.33 1317.73 1179.33 1334.8C1179.33 1350.27 1179.07 1352.67 1177.07 1353.87C1175.2 1354.93 1176.53 1355.2 1182.67 1355.33C1190.27 1355.33 1190.4 1355.2 1187.6 1353.2C1184.8 1351.33 1184.67 1350.27 1184.67 1334C1184.67 1319.07 1184.93 1316.67 1186.93 1315.47C1188.67 1314.53 1187.2 1314.27 1181.33 1314.27C1174.67 1314.27 1173.87 1314.53 1176.4 1315.73Z"
               fill="white" />
            <path
               d="M1197.47 1316.8C1198.93 1318.4 1199.33 1322.93 1199.33 1335.73C1199.33 1350.4 1199.07 1352.67 1197.07 1353.87C1195.33 1354.8 1198.4 1355.07 1207.6 1354.93C1218.27 1354.67 1221.07 1354.13 1224.13 1351.87C1236.93 1342.4 1237.07 1324.8 1224.53 1317.33C1220.93 1315.2 1217.6 1314.67 1207.73 1314.67C1196.53 1314.67 1195.6 1314.8 1197.47 1316.8ZM1218 1317.47C1230.93 1322.67 1233.87 1343.47 1222.53 1350.93C1218.27 1353.73 1208.53 1354 1205.33 1351.33C1203.73 1350 1203.33 1346.53 1203.33 1333.87C1203.33 1320.27 1203.6 1318 1205.73 1316.8C1208.93 1314.8 1211.87 1315.07 1218 1317.47Z"
               fill="white" />
            <path
               d="M1245.47 1331.6C1241.07 1341.33 1236.4 1350.67 1234.93 1352.27L1232.27 1355.33H1238C1243.2 1355.33 1243.6 1355.2 1241.47 1353.6C1239.07 1351.87 1239.07 1351.6 1241.73 1345.6L1244.53 1339.33H1251.87C1259.73 1339.33 1260.93 1340.27 1263.33 1348.8C1264.13 1351.6 1264 1352.93 1262.53 1353.73C1261.33 1354.4 1263.2 1354.8 1267.47 1354.93C1274.13 1355.07 1274.4 1354.93 1271.73 1352.8C1270.13 1351.6 1265.87 1342.67 1262 1332.27C1258.13 1322.27 1254.53 1314 1254.13 1314C1253.6 1314 1249.73 1322 1245.47 1331.6ZM1255.73 1328.27C1256.93 1331.87 1258 1335.07 1258 1335.6C1258 1336.27 1255.2 1336.67 1251.87 1336.67C1247.47 1336.67 1245.87 1336.13 1246.4 1334.93C1250.4 1324.8 1251.73 1322 1252.53 1322C1253.07 1322 1254.53 1324.8 1255.73 1328.27Z"
               fill="white" />
            <path
               d="M936.801 1324.93C933.734 1330.27 930.534 1335.87 929.601 1337.33C920.934 1351.33 919.467 1354 920.401 1354.13C927.867 1355.33 934.667 1354.13 931.334 1352C929.334 1350.8 935.334 1339.47 937.601 1340.27C938.801 1340.8 939.334 1342.13 938.934 1343.6C938.267 1345.87 938.667 1346.13 941.734 1345.33C943.734 1344.8 946.401 1343.33 947.734 1341.87C951.067 1338.27 952.801 1339.2 954.934 1345.33C956.534 1350 956.534 1350.8 954.667 1352.13C951.734 1354.4 952.134 1354.67 957.601 1354.4C965.334 1354 965.467 1354 962.934 1352.53C959.734 1350.67 954.534 1340.27 956.534 1339.6C957.467 1339.33 956.934 1338.27 955.334 1336.93C953.867 1335.6 950.934 1330.53 948.801 1325.33C946.667 1320.27 944.267 1315.87 943.601 1315.6C942.801 1315.33 939.734 1319.6 936.801 1324.93ZM948.534 1328.27C949.601 1331.07 950.667 1334 950.934 1334.93C951.334 1335.87 949.601 1337.47 947.067 1338.4C943.201 1340 942.401 1340 940.401 1338.27C938.134 1336.4 938.267 1335.87 941.734 1329.87C943.734 1326.27 945.601 1323.33 946.001 1323.33C946.534 1323.33 947.601 1325.6 948.534 1328.27Z"
               fill="white" />
            <path
               d="M971.067 1319.6C970.4 1323.87 970.4 1323.87 972.4 1320.93C973.867 1318.67 975.6 1318 980.133 1318H986V1335.33C986 1350.27 985.733 1352.67 983.733 1353.87C981.867 1354.93 983.067 1355.2 988.667 1355.2C994.267 1355.2 995.467 1354.93 993.733 1353.87C991.6 1352.67 991.333 1350.27 991.333 1335.33V1318H998C1002.8 1318 1004.93 1318.67 1005.87 1320.27C1007.07 1322.27 1007.2 1322.13 1007.33 1318.93V1315.33H989.467H971.6L971.067 1319.6Z"
               fill="white" />
            <path
               d="M1124.67 1318.13C1124.67 1319.6 1125.33 1322 1126.13 1323.6C1127.47 1326.13 1127.73 1326 1129.73 1321.73C1131.6 1318 1132.67 1317.33 1136.67 1317.33C1140.67 1317.33 1141.33 1317.87 1142 1321.47C1142.53 1323.73 1142.53 1332 1142.13 1339.73C1141.73 1347.6 1141.47 1354 1141.73 1354C1141.87 1354 1142.67 1352.67 1143.33 1350.93C1144.27 1348.67 1144.53 1348.53 1144.53 1350.27C1144.67 1351.6 1145.6 1352.67 1146.67 1352.67C1147.73 1352.67 1148.67 1351.6 1148.8 1350.27C1148.8 1348.53 1149.07 1348.67 1150 1350.93C1150.67 1352.67 1151.47 1354 1151.6 1354C1152.67 1354 1150.93 1330.53 1149.87 1329.33C1149.07 1328.67 1148.67 1328.8 1148.67 1329.73C1148.67 1330.67 1147.73 1331.33 1146.67 1331.33C1144.53 1331.33 1144.27 1329.47 1145.87 1325.47C1146.8 1323.07 1146.93 1323.07 1147.73 1325.07C1149.07 1328.67 1150.8 1327.73 1151.07 1323.07C1151.47 1317.6 1152.8 1316.4 1157.47 1316.93C1160.27 1317.2 1162 1318.53 1163.47 1321.73C1165.87 1326.53 1167.73 1325.6 1169.33 1318.93L1170.27 1315.33H1147.47C1125.33 1315.33 1124.67 1315.47 1124.67 1318.13ZM1147.47 1337.07C1145.33 1339.2 1144 1337.07 1146.13 1334.53C1147.33 1333.07 1148.13 1332.93 1148.4 1334C1148.67 1334.8 1148.27 1336.27 1147.47 1337.07ZM1148 1345.6C1146.53 1346.53 1145.07 1347.33 1144.4 1347.33C1142.53 1347.33 1143.33 1344.8 1145.6 1343.47C1148.93 1341.73 1150.93 1343.33 1148 1345.6Z"
               fill="white" />
         </svg>
      </a>
      <!-- Boton de colapsar sidebar en vista de computadora -->

      <ul class="space-y-2 font-medium">
         <!-- <div class="flex px-2">
            <h1 class="text-xs font-semibold text-gray-500 dark:text-gray-400">Menú</h1>
            <div class="w-full h-0.5 bg-gray-200 dark:bg-gray-600 self-center"></div>
         </div> -->
         <li>
            <a href="dashboard"
               class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
               </svg>
               <span class="ms-3">Inicio</span>
            </a>
         </li>
         <?php if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "acomercial" || $_SESSION['tipo'] == "comercializacion" || $_SESSION['tipo'] == "coordinador"): ?>
            <li>
               <a href="nuevo"
                  class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
                  <svg
                     class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                     viewBox="0 0 24 24">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>

                  <span class="flex-1 ms-3 whitespace-nowrap">Crear ticket</span>
               </a>
            </li>
         <?php endif; ?>
         <li>
            <a href="tickets"
               class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M18.5 12A2.5 2.5 0 0 1 21 9.5V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2.5a2.5 2.5 0 0 1 0 5V17a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2.5a2.5 2.5 0 0 1-2.5-2.5Z" />
               </svg>

               <span class="flex-1 ms-3 whitespace-nowrap">Ver tickets</span>
            </a>
         </li>
         <?php if ($_SESSION['tipo'] == "tecnico"): ?>
         <li>
            <a href="gestion3"
               class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M4 13h3.439a.991.991 0 0 1 .908.6 3.978 3.978 0 0 0 7.306 0 .99.99 0 0 1 .908-.6H20M4 13v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6M4 13l2-9h12l2 9M9 7h6m-7 3h8" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Gestionar tickets</span>
               <span
                  class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-700 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-300"><?php echo $totalTickets; ?></span>
            </a>
         </li>
         <?php endif; ?>
         <!-- <li>
            <a href="#"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                     d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                     clip-rule="evenodd" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Tracking</span>
            </a>
         </li> -->
         <?php if ($_SESSION['tipo'] != "tecnico"): ?>
         <li>
            <button type="button" href="gestion"
               class="flex items-center w-full p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300"
               aria-controls="dropdown-gestion" data-collapse-toggle="dropdown-gestion"
               data-dropdown-id="dropdown-gestion">
               <svg
                  class="flex-shrink-0 w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M4 13h3.439a.991.991 0 0 1 .908.6 3.978 3.978 0 0 0 7.306 0 .99.99 0 0 1 .908-.6H20M4 13v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6M4 13l2-9h12l2 9M9 7h6m-7 3h8" />
               </svg>
               <span class="flex-1 ml-3 text-left rtl:text-right whitespace-nowrap">Gestión</span>
               <svg
                  class="w-5 h-5 text-gray-200 group-hover:text-gray-900 dark:group-hover:text-white transition-transform duration-300"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="m9 5 7 7-7 7" />
               </svg>
            </button>
            <ul id="dropdown-gestion" class="hidden py-2 space-y-2">
               <li class="group transition duration-300 transform hover:translate-x-2">
                  <a href="gestion3"
                     class="flex items-center w-full p-2 text-left text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900 dark:text-white dark:hover:bg-gray-700 group">
                     <svg
                        class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                           d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                     </svg>

                     <span class="ml-2">Tickets</span>
                     <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-700 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-300"><?php echo $totalTickets; ?></span>
                  </a>
               </li>
               <?php if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "coordinador"): ?>
                  <li class="group transition duration-300 transform hover:translate-x-2">
                     <a href="usuarios"
                        class="flex items-center w-full p-2 text-left text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900 dark:text-white dark:hover:bg-gray-700">
                        <svg
                           class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                           aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                           <path fill-rule="evenodd"
                              d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                              clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">Usuarios</span>
                     </a>
                  </li>
               <?php endif; ?>
               <li class="group transition duration-300 transform hover:translate-x-2">
                  <a href="clientes"
                     class="flex items-center w-full p-2 text-left text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900 dark:text-white dark:hover:bg-gray-700">
                     <svg
                        class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                           d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                           clip-rule="evenodd" />
                     </svg>
                     <span class="ml-2">Clientes</span>
                  </a>
               </li>
               <?php if ($_SESSION['tipo'] == "admin"): ?>
                  <li class="group transition duration-300 transform hover:translate-x-2">
                     <a href="articulos"
                        class="flex items-center w-full p-2 text-left text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900 dark:text-white dark:hover:bg-gray-700">
                        <svg
                           class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                           xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                           <path fill="currentColor" fill-rule="evenodd"
                              d="M4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v4H4zm4 2V3h1v2z" clip-rule="evenodd" />
                           <path fill="currentColor" d="M2 8v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V8h-3v2h-1V8H6v2H5V8z" />
                        </svg>
                        <span class="ml-2">Artículos</span>
                     </a>
                  </li>
               <?php endif; ?>
            </ul>
         </li>
         <?php endif; ?>
         <li>
            <button type="button" href="encuestas"
               class="flex items-center w-full p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300"
               aria-controls="dropdown-encuestas" data-collapse-toggle="dropdown-encuestas"
               data-dropdown-id="dropdown-encuestas">
               <svg xmlns="http://www.w3.org/2000/svg"
                  class="flex-shrink-0 w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="2">
                     <circle cx="12" cy="12" r="10" />
                     <path stroke-linecap="round"
                        d="M10 8.484C10.5 7.494 11 7 12 7c1.246 0 2 .989 2 1.978s-.5 1.483-2 2.473V13m0 3.5v.5" />
                  </g>
               </svg>
               <span class="flex-1 ml-3 text-left rtl:text-right whitespace-nowrap">Encuestas</span>
               <svg
                  class="w-5 h-5 text-gray-200 group-hover:text-gray-900 dark:group-hover:text-white transition-transform duration-300"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="m9 5 7 7-7 7" />
               </svg>
            </button>
            <ul id="dropdown-encuestas" class="hidden py-2 space-y-2">
               <li class="group transition duration-300 transform hover:translate-x-2">
                  <a href="encuestas-pendientes"
                     class="flex items-center w-full p-2 text-left text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900 dark:text-white dark:hover:bg-gray-700 group">
                     <svg
                        class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                           d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                           clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                           d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                           clip-rule="evenodd" />
                     </svg>
                     <span class="ml-2">Pendientes</span>
                     <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-700 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-300"><?php echo $totalEncuestas; ?></span>
                  </a>
               </li>
               <li class="group transition duration-300 transform hover:translate-x-2">
                  <a href="encuestas-contestadas"
                     class="flex items-center w-full p-2 text-left text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900 dark:text-white dark:hover:bg-gray-700">
                     <svg
                        class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                        <path fill-rule="evenodd"
                           d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                           clip-rule="evenodd" />
                     </svg>
                     <span class="ml-2">Contestadas</span>
                  </a>
               </li>
            </ul>
         </li>
         <li>
            <a href="cambios"
               class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5" />
               </svg>

               <span class="flex-1 ms-3 whitespace-nowrap">Cambios</span>
               <span
                  class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-700 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-300"><?php echo $totalTickets; ?></span>
            </a>
         </li>
         <!-- <?php if ($_SESSION['tipo'] == "admin" || $_SESSION['tipo'] == "coordinador"): ?>
            <li>
               <a href="bitacora"
                  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
                  <svg
                     class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                     <path fill-rule="evenodd"
                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                        clip-rule="evenodd" />
                  </svg>
                  <span class="flex-1 ms-3 whitespace-nowrap">Bitacora de usuarios</span>
               </a>
            </li>
         <?php endif; ?> -->
         <!-- <div class="w-full h-px drop-shadow-xl bg-gray-200 dark:bg-gray-600 self-center"></div>
         <div class="flex px-2 pt-2">
            <h1 class="text-xs font-semibold text-gray-500 dark:text-gray-400">Troubleshooting</h1>
            <div class="w-full h-0.5 bg-gray-200 dark:bg-gray-600 self-center"></div>
         </div> -->
         <!-- <li class="group transition duration-300 transform hover:translate-x-2">
            <a href="faq"
               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">FAQ</span>
            </a>
         </li> -->
      </ul>
   </div>
   <div class="px-3 mb-3">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="faq"
               class="flex items-center p-2 text-gray-100 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 group transition duration-300 transform hover:translate-x-2">
               <svg
                  class="w-5 h-5 text-gray-200 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Ayuda</span>
            </a>
         </li>
      </ul>
   </div>

   <?php if ($userRow = $userResult->fetch_assoc()): ?>
      <button type="button"
         class="flex mx-3 rounded-lg mb-8 py-2 sm:mb-0 text-left px-3 gap-4 hover:bg-blue-700 focus:bg-blue-700 hover:border-blue-800 dark:focus:bg-gray-700 focus:border-blue-800 dark:hover:bg-gray-700"
         aria-expanded="false" data-dropdown-toggle="userDropdown">
         <div class="relative">
            <?php if ($_SESSION['imagen']): ?>
               <img class="w-10 h-10 rounded-full" src="../../assets/imgUsers/<?php echo $_SESSION['imagen']; ?>"
                  alt="Imagen de usuario">
            <?php else: ?>
               <img class="w-10 h-10 rounded-full" src="../../assets/imgUsers/default.png" alt="Imagen de usuario">
            <?php endif; ?>
            <span
               class="bottom-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
         </div>
         <div class="font-medium text-gray-100 dark:text-white">
            <div>
               <?php echo $_SESSION['nombre']; ?>
               <?php echo $_SESSION['apellido']; ?>
            </div>
            <div class="text-xs text-gray-300 dark:text-gray-400">
               <?php echo userType($_SESSION['tipo']); ?>
            </div>
         </div>
      </button>

      <div id="userDropdown"
         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
         <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
            <li>
               <a href="gestion" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mis
                  asignaciones</a>
            </li>
            <li>
               <a href="ajustes"
                  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ajustes</a>
            </li>
            <li>
               <a type="button" data-animation="polygon"
                  class="theme-toggle block cursor-pointer px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modo
                  oscuro</a>
            </li>
         </ul>
         <div class="py-1">
            <a href="../configuration/logout.php"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Cerrar
               sesión</a>
         </div>
      </div>
   <?php endif; ?>


   <div class="text-center mb-3 text-xs text-gray-300 dark:text-gray-400 mt-4">Versión 2.0.4</div>
</aside>

<div id="dropdown-notifications"
   class="z-50 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
   aria-labelledby="dropdownNotificationButton">
   <div
      class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
      Notificaciones</div>
   <div class="divide-y divide-gray-100 dark:divide-gray-500">
      <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
         <div class="flex-shrink-0">
            <img class="rounded-full w-11 h-11" src="../../assets/imgUsers/default.png" alt="Imagen de usuario">
            <div
               class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
               <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                  viewBox="0 0 18 18">
                  <path
                     d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                  <path
                     d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
               </svg>
            </div>
         </div>
         <div class="w-full ps-3">
            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"><span
                  class="font-semibold text-gray-900 dark:text-white">Nombre</span>: Mensaje</div>
            <div class="text-xs text-blue-600 dark:text-blue-500">Fecha y/o tiempo</div>
         </div>
      </a>
   </div>
   <a href="#"
      class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
      <div class="inline-flex items-center">
         <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
            <path
               d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
         </svg>
         Ver todas las notificaciones
      </div>
   </a>
</div>

<script src="js/sidebar-drop.js"></script>
<script src="js/animation.js"></script>
<script src="js/light-dark.js" type="module"></script>

<!-- Notificaction url: https://flowbite.com/docs/components/toast/#push-notification -->

<!-- <div id="toast-success"
   class="fixed flex items-center w-full max-w-xs z-50 p-4 mt-11 text-gray-500 bg-white rounded-lg shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800"
   role="alert">
   <div
      class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
         viewBox="0 0 20 20">
         <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
      </svg>
      <span class="sr-only">Check icon</span>
   </div>
   <div class="ms-3 text-sm font-normal">Ticket creado exitosamente.</div>
   <button type="button"
      class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
      data-dismiss-target="#toast-success" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
   </button>
</div> -->

<!-- <div id="toast-notification"
   class="fixed block w-full max-w-xs z-50 p-4 mt-11 text-gray-900 bg-white rounded-lg shadow top-5 right-5 dark:bg-gray-800 dark:text-gray-300"
   role="alert">
   <div class="flex items-center mb-3">
      <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">New notification</span>
      <button type="button"
         class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
         data-dismiss-target="#toast-notification" aria-label="Close">
         <span class="sr-only">Close</span>
         <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
         </svg>
      </button>
   </div>
   <div class="flex items-center">
      <div class="relative inline-block shrink-0">
         <img class="w-12 h-12 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Jese Leos image" />
         <span
            class="absolute bottom-0 right-0 inline-flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full">
            <svg class="w-3 h-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18"
               fill="currentColor">
               <path
                  d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z"
                  fill="currentColor" />
               <path
                  d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z"
                  fill="currentColor" />
            </svg>
            <span class="sr-only">Message icon</span>
         </span>
      </div>
      <div class="ms-3 text-sm font-normal">
         <div class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</div>
         <div class="text-sm font-normal">commented on your photo</div>
         <span class="text-xs font-medium text-blue-600 dark:text-blue-500">a few seconds ago</span>
      </div>
   </div>
</div> -->