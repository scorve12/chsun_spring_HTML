<?php
    include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
    ?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128|VT323" rel="stylesheet">
    <title>당백전_개인사업자를 위한 사이트</title>
    <!-- font, css, style 링크-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="/css/calculator.css">

    <script type="text/javascript" src="./calculator.js"></script>
</head>

<body>
    <div id="wrap">
        <!-- Weekly Calculation Form -->
        <div id="FormWrap">
            <h2>부가가치세 (합계금액)</h2>
            <form id="vatSumForm">
                <div id="FormContent">
                    <label for="totalSum">합계금액:</label><input type="number" id="totalSum" name="totalSum" step="10000"
                        value="0" required>
                </div>
                <button type="button" onclick="calculateVatSum()">계산</button>
            </form>
            <p class="result-container">결과: <span id="vatSumResult"></span></p>
        </div>
        <!-- VAT Calculation Form (Supply Price) -->
        <div id="FormWrap">
            <h2>부가가치세 (공급가액)</h2>
            <form id="vatSupplyForm">
                <label for="supplyPrice">공급가액:</label>
                <input type="number" id="supplyPrice" name="supplyPrice" step="10000" value="0" required>
                <button type="button" onclick="calculateVatSupply()">계산</button>
            </form>
            <p class="result-container">결과: <span id="vatSupplyResult"></span></p>
        </div>
        <div id="FormWrap">
            <h2>주휴수당 계산</h2>
            <form id="weeklyForm">
                <div id="FormContent">
                    <label for="hour">시간:</label><input type="number" id="hour" name="hour" step="1" value="0"
                        required><br>
                    <label for="minute">분:</label><input type="number" id="minute" name="minute" step="10" value="0"
                        required><br>
                    <label for="wage">시급:</label><input type="number" id="wage" name="wage" step="1000" value="9860"
                        required><br>
                </div>
                <button type="button" onclick="calculateWeekly()">계산</button>
            </form>
            <p class="result-container">결과: <span id="weeklyResult"></span></p>
        </div>

        <!-- Wage Calculation Form -->
        <div id="FormWrap">
            <h2>시급 계산</h2>
            <form id="wageForm">
                <label for="hear">시급:</label><input type="number" id="hear" name="hear" step="1000" value="9860"
                    required>
                <label for="dayworktime">근무시간:</label><input type="number" id="dayworktime" name="dayworktime" step="1"
                    value="0" required>
                <label for="monthworkday">근무일수:</label><input type="number" id="monthworkday" name="monthworkday"
                    step="1" value="0" required>
                <label for="tranningset">수습 적용:</label><input type="number" id="tranningset" name="tranningset" step="1"
                    value="0" required>
                <label for="taxtypeval">세금 구분:</label><input type="number" step="0.0001" id="taxtypeval"
                    name="taxtypeval" step="0.01" value="0.0913" required>
                <button type="button" onclick="calculateWage()">계산</button>
            </form>
            <p class="result-container">결과: <span id="wageResult"></span></p>
        </div>
        <!-- Weekly Calculation Form -->
        <div id="FormWrap">
            <h2>급여 계산기</h2>
            <form id="payForm">
                <label for="severance">퇴직금 여부:</label><input type="number" id="severance" name="severance" step="1"
                    value="1" required>
                <label for="taxFreeLb">비과세액:</label><input type="number" id="taxFreeLb" name="taxFreeLb" step="10000"
                    value="0" required>
                <label for="supportLb">부양가족 수:</label><input type="number" id="supportLb" name="supportLb" step="1"
                    value="0" required>
                <label for="annIncome">연봉:</label><input type="number" id="annIncome" name="annIncome" step="1000000"
                    value="10000000" required>
                <button type="button" onclick="calculatePay()">계산</button>
            </form>
            <p class="result-container">결과: <span id="payResult"></span></p>
        </div>

        <!-- Salary Calculation Form -->
        <div id="FormWrap">
            <h2>급여 계산기 (월급)</h2>
            <form id="salaryForm">
                <label for="taxFreeLbS">비과세액:</label><input type="number" id="taxFreeLbS" name="taxFreeLbS" step="10000"
                    value="0" required>
                <label for="supportLbS">부양가족 수:</label><input type="number" id="supportLbS" name="supportLbS" step="1"
                    value="0" required>
                <label for="annIncomeS">월급:</label><input type="number" id="annIncomeS" name="annIncomeS" step="10000"
                    value="0" required>
                <button type="button" onclick="calculateSalary()">계산</button>
            </form>
            <p class="result-container">결과: <span id="salaryResult"></span></p>
        </div>

        <!-- Wage Calculation Form -->
        <div id="FormWrap">
            <h2>4대보험 계산</h2>
            <form id="insuranceForm">
                <label for="salary">월 급여:</label><input type="number" id="salary" name="salary" step="10000" value="0"
                    required>
                <label for="workers">근로자 수:</label><input type="number" id="workers" name="workers" step="10000"
                    value="0" required>
                <label for="accident">산재보험율:</label><input type="number" step="0.0001" id="accident" name="accident"
                    step="10000" value="0" required>
                <button type="button" onclick="calculateInsurance()">계산</button>
            </form>
            <p class="result-container">결과: <span id="insuranceResult"></span></p>
        </div>
        <!-- Retirement Calculation Form -->
        <div id="FormWrap">
            <h2>퇴직금 계산</h2>
            <form id="retirementForm">
                <label for="entryDtR">입사일:</label><input type="date" id="entryDtR" name="entryDtR" required>
                <label for="calcDtR">퇴사일:</label><input type="date" id="calcDtR" name="calcDtR" required>
                <label for="yearly">연간 상여금:</label><input type="number" id="yearly" name="yearly" required>
                <label for="annual">연차수당:</label><input type="number" id="annual" name="annual" required>
                <button type="button" onclick="calculateRetirement()">계산</button>
            </form>
            <p class="result-container">결과: <span id="retirementResult"></span></p>
        </div>
    </div>
</body>

<script>
    document.querySelectorAll('.gnb > li').forEach(li => {
        const subMenu = li.querySelector('.sub-wrap');
        if (subMenu) {
            li.addEventListener('mouseover', () => subMenu.classList.add('active'));
            li.addEventListener('mouseleave', () => subMenu.classList.remove('active'));
        }
    });
</script>

</html>