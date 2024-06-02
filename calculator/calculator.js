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

document.querySelectorAll('.gnb > li').forEach(li => {
    const subMenu = li.querySelector('.sub-wrap');
    if (subMenu) {
        li.addEventListener('mouseover', () => subMenu.classList.add('active'));
        li.addEventListener('mouseleave', () => subMenu.classList.remove('active'));
    }
});