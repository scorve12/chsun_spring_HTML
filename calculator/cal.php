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
    <link rel="stylesheet" href="/css/calculator.css">

    <script type="text/javascript">
        let currentSlide = 0;
        const forms = document.querySelectorAll('#wrap form');
        
        function showSlide(index) {
            forms.forEach((form, i) => {
                form.classList.toggle('active', i === index);
            });
        }
    
        function nextSlide() {
            currentSlide = (currentSlide + 1) % forms.length;
            showSlide(currentSlide);
        }
    
        function prevSlide() {
            currentSlide = (currentSlide - 1 + forms.length) % forms.length;
            showSlide(currentSlide);
        }
    
        // Initialize the first slide
        showSlide(currentSlide);
    </script>
</head>

<body>
    <div id="wrap">
        <script type="text/javascript" src="/js/calculator.js"></script>
        <h1>계산기</h1>

        <!-- Weekly Calculation Form -->

        <h2>주휴수당 계산</h2>
        <form id="weeklyForm">
            <label for="hour">시간:</label>
            <input type="number" id="hour" name="hour" required>
            <label for="minute">분:</label>
            <input type="number" id="minute" name="minute" required>
            <label for="wage">시급:</label>
            <input type="number" id="wage" name="wage" required>
            <button type="button" onclick="calculateWeekly()">계산</button>
        </form>
        <p>결과: <span id="weeklyResult"></span></p>

        <!-- Annual Calculation Form -->
        <h2>연차계산</h2>
        <form id="annualForm">
            <label for="entryDt">입사일:</label>
            <input type="date" id="entryDt" name="entryDt" required>
            <label for="calcDt">기준일자:</label>
            <input type="date" id="calcDt" name="calcDt" required>
            <button type="button" onclick="calculateAnnual()">계산</button>
        </form>
        <p>결과: <span id="annualResult"></span></p>

        <!-- Wage Calculation Form -->
        <h2>시급 계산</h2>
        <form id="wageForm">
            <label for="hear">시급:</label>
            <input type="number" id="hear" name="hear" required>
            <label for="dayworktime">일일 근무시간:</label>
            <input type="number" id="dayworktime" name="dayworktime" required>
            <label for="monthworkday">한달 근무일수:</label>
            <input type="number" id="monthworkday" name="monthworkday" required>
            <label for="tranningset">수습 적용 (0 or 1):</label>
            <input type="number" id="tranningset" name="tranningset" required>
            <label for="taxtypeval">세금 구분 (예: 0.0913):</label>
            <input type="number" step="0.0001" id="taxtypeval" name="taxtypeval" required>
            <button type="button" onclick="calculateWage()">계산</button>
        </form>
        <p>결과: <span id="wageResult"></span></p>

        <!-- Retirement Calculation Form -->
        <h2>퇴직금 계산</h2>
        <form id="retirementForm">
            <label for="entryDtR">입사일:</label>
            <input type="date" id="entryDtR" name="entryDtR" required>
            <label for="calcDtR">퇴사일:</label>
            <input type="date" id="calcDtR" name="calcDtR" required>
            <label for="yearly">연간 상여금:</label>
            <input type="number" id="yearly" name="yearly" required>
            <label for="annual">연차수당:</label>
            <input type="number" id="annual" name="annual" required>
            <button type="button" onclick="calculateRetirement()">계산</button>
        </form>
        <p>결과: <span id="retirementResult"></span></p>

        <!-- Insurance Calculation Form -->
        <h2>4대보험 계산</h2>
        <form id="insuranceForm">
            <label for="salary">월 급여:</label>
            <input type="number" id="salary" name="salary" required>
            <label for="workers">근로자 수:</label>
            <input type="number" id="workers" name="workers" required>
            <label for="accident">산재보험료율:</label>
            <input type="number" step="0.0001" id="accident" name="accident" required>
            <button type="button" onclick="calculateInsurance()">계산</button>
        </form>
        <p>결과: <span id="insuranceResult"></span></p>

        <!-- Pay Calculation Form -->
        <h2>급여 계산기</h2>
        <form id="payForm">
            <label for="severance">퇴직금 포함 여부 (0 or 1):</label>
            <input type="number" id="severance" name="severance" required>
            <label for="taxFreeLb">비과세액:</label>
            <input type="number" id="taxFreeLb" name="taxFreeLb" required>
            <label for="supportLb">부양가족 수:</label>
            <input type="number" id="supportLb" name="supportLb" required>
            <label for="annIncome">연봉:</label>
            <input type="number" id="annIncome" name="annIncome" required>
            <button type="button" onclick="calculatePay()">계산</button>
        </form>
        <p>결과: <span id="payResult"></span></p>

        <!-- Salary Calculation Form -->
        <h2>급여 계산기 (월급)</h2>
        <form id="salaryForm">
            <label for="taxFreeLbS">비과세액:</label>
            <input type="number" id="taxFreeLbS" name="taxFreeLbS" required>
            <label for="supportLbS">부양가족 수:</label>
            <input type="number" id="supportLbS" name="supportLbS" required>
            <label for="annIncomeS">월급:</label>
            <input type="number" id="annIncomeS" name="annIncomeS" required>
            <button type="button" onclick="calculateSalary()">계산</button>
        </form>
        <p>결과: <span id="salaryResult"></span></p>

        <!-- VAT Calculation Form (Total Sum) -->
        <h2>부가세 계산 (합계금액)</h2>
        <form id="vatSumForm">
            <label for="totalSum">합계금액:</label>
            <input type="number" id="totalSum" name="totalSum" required>
            <button type="button" onclick="calculateVatSum()">계산</button>
        </form>
        <p>결과: <span id="vatSumResult"></span></p>

        <!-- VAT Calculation Form (Supply Price) -->
        <h2>부가세 계산 (공급가액)</h2>
        <form id="vatSupplyForm">
            <label for="supplyPrice">공급가액:</label>
            <input type="number" id="supplyPrice" name="supplyPrice" required>
            <button type="button" onclick="calculateVatSupply()">계산</button>
        </form>
        <p>결과: <span id="vatSupplyResult"></span></p>
    </div>
</body>

<script>
    // JavaScript functions to handle the form submissions
    function calculateWeekly() {
        const hour = parseFloat(document.getElementById('hour').value);
        const minute = parseFloat(document.getElementById('minute').value);
        const wage = parseFloat(document.getElementById('wage').value);
        const result = calculate.weekly(hour, minute, wage);
        document.getElementById('weeklyResult').innerText = result;
    }

    function calculateAnnual() {
        const entryDt = document.getElementById('entryDt').value;
        const calcDt = document.getElementById('calcDt').value;
        const result = calculate.annual(entryDt, calcDt);
        document.getElementById('annualResult').innerText = `근속연수: ${result[0]}, 연차일수: ${result[1]}`;
    }

    function calculateWage() {
        const hear = parseFloat(document.getElementById('hear').value);
        const dayworktime = parseFloat(document.getElementById('dayworktime').value);
        const monthworkday = parseFloat(document.getElementById('monthworkday').value);
        const tranningset = parseInt(document.getElementById('tranningset').value);
        const taxtypeval = parseFloat(document.getElementById('taxtypeval').value);
        const result = calculate.wage(hear, dayworktime, monthworkday, tranningset, taxtypeval);
        document.getElementById('wageResult').innerText = `시급: ${result[0]}, 근무시간: ${result[1]}, 실수령액: ${result[2]}`;
    }

    function calculateRetirement() {
        const entryDtR = document.getElementById('entryDtR').value;
        const calcDtR = document.getElementById('calcDtR').value;
        const yearly = parseFloat(document.getElementById('yearly').value);
        const annual = parseFloat(document.getElementById('annual').value);
        const result = calculate.retirement(entryDtR, calcDtR, yearly, annual);
        document.getElementById('retirementResult').innerText = `예상 퇴직금: ${result[15]}, 재직일수: ${result[14]}`;
    }

    function calculateInsurance() {
        const salary = parseFloat(document.getElementById('salary').value);
        const workers = parseInt(document.getElementById('workers').value);
        const accident = parseFloat(document.getElementById('accident').value);
        const result = calculate.insurance(salary, workers, accident);
        document.getElementById('insuranceResult').innerText = `국민연금: 근로자 부담금 ${result[0]}, 사업자 부담금 ${result[1]}, 총액 ${result[2]}, 건강보험: 근로자 부담금 ${result[3]}, 사업자 부담금 ${result[4]}, 총액 ${result[5]}, 장기요양: 근로자 부담금 ${result[6]}, 사업자 부담금 ${result[7]}, 총액 ${result[8]}, 고용보험: 사업주 부담액 ${result[9]}, 근로자 부담액 ${result[10]}, 총액 ${result[11]}, 산재보험료율: ${result[12]}`;
    }

    function calculatePay() {
        const severance = parseInt(document.getElementById('severance').value);
        const taxFreeLb = parseFloat(document.getElementById('taxFreeLb').value);
        const supportLb = parseInt(document.getElementById('supportLb').value);
        const annIncome = parseFloat(document.getElementById('annIncome').value);
        const result = calculate.pay(severance, taxFreeLb, supportLb, annIncome);
        document.getElementById('payResult').innerText = `예상 실수령액: ${result[0]}, 국민연금: ${result[1]}, 건강보험: ${result[2]}, 장기요양: ${result[3]}, 고용보험: ${result[4]}, 간이세액: ${result[5]}, 지방소득세: ${result[6]}, 공제액 합계: ${result[7]}`;
    }

    function calculateSalary() {
        const taxFreeLbS = parseFloat(document.getElementById('taxFreeLbS').value);
        const supportLbS = parseInt(document.getElementById('supportLbS').value);
        const annIncomeS = parseFloat(document.getElementById('annIncomeS').value);
        const result = calculate.salary(taxFreeLbS, supportLbS, annIncomeS);
        document.getElementById('salaryResult').innerText = `예상 실수령액: ${result[0]}, 국민연금: ${result[1]}, 건강보험: ${result[2]}, 장기요양: ${result[3]}, 고용보험: ${result[4]}, 간이세액: ${result[5]}, 지방소득세: ${result[6]}, 공제액 합계: ${result[7]}`;
    }

    function calculateVatSum() {
        const totalSum = parseFloat(document.getElementById('totalSum').value);
        const result = calculate.vatSum(totalSum);
        document.getElementById('vatSumResult').innerText = `공급가액: ${result[0]}, 부가세액: ${result[1]}, 합계금액: ${result[2]}`;
    }

    function calculateVatSupply() {
        const supplyPrice = parseFloat(document.getElementById('supplyPrice').value);
        const result = calculate.vatSupplyPrice(supplyPrice);
        document.getElementById('vatSupplyResult').innerText = `부가세액: ${result[0]}, 합계금액: ${result[1]}`;
    }
</script>
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