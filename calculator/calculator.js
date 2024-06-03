
// 요율
const GLOBAL_VALUE = {
    EI_UN_WORKER: 0.009,        // 고용보험 실업급여 근로자
    EI_150L_OWNER: 0.0025,      // 고용보험 150미만 사업주
    EI_150H_OWNER: 0.0045,      // 고용보험 150이상 사업주
    EI_1000L_OWNER: 0.0065,     // 고용보험 1000미만 사업주
    EI_1000H_OWNER: 0.0085,     // 고용보험 1000이상 사업주
    NATIONAL_PENSION_RATE: 0.045,  // 국민연금: 전체: 9%, 근로자: 4.5%, 사업주: 4.5%
    HEALTH_INSURE_RATE: 0.03545,   // 건강보험: 전체: 7.09%, 근로자: 3.545%, 사업주: 3.545%
    HEALTH_INSURE_CARE_RATE: 0.1295  // 장기요양(건강보험): 전체: 12.95%, 근로자, 사업주: 각각 50%
  };
  
  // Utility functions
  const util = {
    commaNum: value => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),
    maxDayOfYearMonth: (yyyy, mm) => {
      const monthDD = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
      if (util.isLeapYear(yyyy)) monthDD[1] = 29;
      return monthDD[mm - 1];
    },
    isLeapYear: YYYY => (YYYY % 4 === 0 && YYYY % 100 !== 0) || YYYY % 400 === 0,
    round: (num, pos = 2) => Math.floor(num * Math.pow(10, pos)) / Math.pow(10, pos),
    formatDate: date => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`
  };
  
  // Salary calculation functions
  const salary = {
    pension: minusPrice => Math.floor((minusPrice * GLOBAL_VALUE.NATIONAL_PENSION_RATE) / 10) * 10,
    health: minusPrice => Math.floor((minusPrice * GLOBAL_VALUE.HEALTH_INSURE_RATE) / 10) * 10,
    care: medical => Math.floor((medical * GLOBAL_VALUE.HEALTH_INSURE_CARE_RATE) / 10) * 10,
    insurance: minusPrice => Math.floor((minusPrice * GLOBAL_VALUE.EI_UN_WORKER) / 10) * 10,
    localTax: simplifiedTax => Math.floor((simplifiedTax * 0.1) / 10) * 10,
    totalDeductible: (pension, medical, care, employ, simplifiedTax, localIncomeTax) => {
      return Math.floor((pension + medical + care + employ + simplifiedTax + localIncomeTax) / 10) * 10;
    }
  };
  
  // Income calculation functions
  const income = {
    yearSalary: (division, annIncome, taxFreeLb) => division === 0 ? annIncome - taxFreeLb : (annIncome - taxFreeLb) * 12,
    deduction: annualSalary => {
      if (annualSalary <= 5000000) return (annualSalary * 0.7);
      if (annualSalary <= 15000000) return 3500000 + (annualSalary - 5000000) * 0.4;
      if (annualSalary <= 45000000) return 7500000 + (annualSalary - 15000000) * 0.15;
      if (annualSalary <= 100000000) return 12000000 + (annualSalary - 45000000) * 0.05;
      return 14750000 + (annualSalary - 100000000) * 0.02;
    },
    amount: (annualSalary, earnedIncome) => annualSalary - earnedIncome,
    personal: setSupportLb => setSupportLb * 1500000,
    pension: annualSalary => {
      if (annualSalary < 290000) return 156600;
      if (annualSalary < 4490000) return 2424600;
      return annualSalary * 0.045;
    },
    special: (setAnnIncome, setSupportLb, annualSalary) => {
      let specialIncome = 0;
      if (setAnnIncome <= 30000000) {
        if (setSupportLb === 1) specialIncome = 3100000 + annualSalary * 0.04;
        else if (setSupportLb === 2) specialIncome = 3600000 + annualSalary * 0.04;
        else specialIncome = 5000000 + annualSalary * 0.07 + (annualSalary - 40000000) * 0.04;
      } else if (setAnnIncome <= 45000000) {
        if (setSupportLb === 1) specialIncome = 3100000 + annualSalary * 0.04 - (annualSalary - 30000000) * 0.05;
        else if (setSupportLb === 2) specialIncome = 3600000 + annualSalary * 0.04 - (annualSalary - 30000000) * 0.05;
        else specialIncome = 5000000 + annualSalary * 0.07 - (annualSalary - 30000000) * 0.05 + (annualSalary - 40000000) * 0.04;
      } else if (setAnnIncome <= 70000000) {
        if (setSupportLb === 1) specialIncome = 3100000 + annualSalary * 0.015;
        else if (setSupportLb === 2) specialIncome = 3600000 + annualSalary * 0.02;
        else specialIncome = 5000000 + annualSalary * 0.05 + (annualSalary - 40000000) * 0.04;
      } else if (setAnnIncome <= 120000000) {
        if (setSupportLb === 1) specialIncome = 3100000 + annualSalary * 0.05;
        else if (setSupportLb === 2) specialIncome = 3600000 + annualSalary * 0.01;
        else specialIncome = 5000000 + annualSalary * 0.03 + (annualSalary - 40000000) * 0.04;
      }
      return specialIncome;
    },
    taxBase: (earnedIncomePrice, personal, pensionInsurance, specialIncome) => earnedIncomePrice - personal - pensionInsurance - specialIncome,
    calculatedTax: taxBase => {
      if (taxBase <= 12000000) return taxBase * 0.06;
      if (taxBase <= 46000000) return 720000 + ((taxBase - 12000000) * 0.15);
      if (taxBase <= 88000000) return 5820000 + ((taxBase - 46000000) * 0.24);
      if (taxBase <= 150000000) return 15900000 + ((taxBase - 88000000) * 0.35);
      if (taxBase <= 300000000) return 37600000 + ((taxBase - 150000000) * 0.38);
      if (taxBase <= 500000000) return 94600000 + ((taxBase - 300000000) * 0.4);
      return 174600000 + ((taxBase - 500000000) * 0.42);
    },
    earned: calculatedTax => calculatedTax <= 500000 ? calculatedTax * 0.55 : 275000 + ((calculatedTax - 500000) * 0.3),
    determinedTax: (earnedIncomeTax, calculatedTax) => earnedIncomeTax - calculatedTax,
    simplifiedTax: determinedTax => determinedTax < 0 ? 0 : Math.floor(determinedTax / 12 / 10) * 10
  };
  
  // Calculation functions
  const calculate = {
    weekly: (hour, minute, wage) => {
      const weekJobTime = hour + (minute / 60).toFixed(2);
      if (wage <= 1000) return 0;
  
      let weekRestPrice = 0;
      if (weekJobTime >= 15) {
        weekRestPrice = weekJobTime >= 40 ? 8 * wage : (weekJobTime / 40) * 8 * wage;
      }
      return util.commaNum(Math.round(weekRestPrice));
    },
    annual: (entryDt, calcDt) => {
      const startDt = new Date(entryDt);
      const endDt = new Date(calcDt);
  
      const diffYears = endDt.getFullYear() - startDt.getFullYear();
      const diffMonths = endDt.getMonth() - startDt.getMonth();
      const diffDates = endDt.getDate() - startDt.getDate();
  
      const diffMonth = diffYears * 12 + diffMonths + (diffDates >= 0 ? 0 : -1);
  
      const annualVacation = [
        11, 15, 15, 16, 16, 17, 17, 18, 18, 19, 19, 20,
        20, 21, 21, 22, 22, 23, 23, 24, 24, 25
      ];
  
      return diffMonth >= 12 ? [Math.floor(diffMonth / 12), annualVacation[Math.floor(diffMonth / 12)] || 25] : [0, diffMonth];
    },
    wage: (hear, dayworktime, monthworkday, tranningset, taxtypeval) => {
      const totalDateSum = hear * dayworktime * monthworkday;
      let resultmoney = totalDateSum;
  
      if (taxtypeval !== 0) resultmoney -= totalDateSum * taxtypeval;
      if (tranningset === 0) resultmoney -= resultmoney * 0.1;
  
      return [
        util.commaNum(hear),
        dayworktime * monthworkday,
        util.commaNum(Math.round(resultmoney))
      ];
    },
    retirement: (entryDt, calcDt, yearly, annual) => {
      const startDt = new Date(entryDt);
      const endDt = new Date(calcDt);
      const termDays = Math.ceil((endDt - startDt) / (1000 * 60 * 60 * 24));
  
      let endMon = parseInt(calcDt.substring(5, 7));
      const endDay = calcDt.substring(8, 10);
      const endYear = calcDt.substring(0, 4);
  
      let idx = parseInt(endDay) - 1 > 0 ? 4 : 3;
      if ((endMon + endDay === "529" && !util.isLeapYear(endYear)) || endMon + endDay === "530" || endMon + endDay === "531") idx = 3;
  
      const arrRetirement = Array(19).fill('');
      arrRetirement[14] = termDays;
  
      let sumDate = 0;
      for (let i = 1; i <= idx; i++) {
        let yy = endYear, mm = endMon - idx + i;
        if (mm <= 0) {
          yy = endYear - 1;
          mm += 12;
        }
        const dd = i === idx && parseInt(endDay) - 1 > 0 ? parseInt(endDay) - 1 : 1;
        const ddEnd = util.maxDayOfYearMonth(yy, mm);
  
        const frontDate = `${yy}.${mm}.${dd}`;
        arrRetirement[i] = frontDate;
  
        if (ddEnd && dd !== ddEnd) {
          const rearDate = `${yy}.${mm}.${ddEnd}`;
          arrRetirement[i + 3] = rearDate;
  
          const s = new Date(yy, mm - 1, dd);
          const e = new Date(yy, mm - 1, ddEnd);
          const countDay = Math.ceil((e - s) / (1000 * 60 * 60 * 24)) + 1;
          arrRetirement[i + 7] = countDay;
          sumDate += countDay;
        }
      }
      arrRetirement[13] = sumDate;
  
      const basic1 = Number(document.getElementById("basic1").innerText.replace(/,/g, ""));
      const basic2 = Number(document.getElementById("basic2").innerText.replace(/,/g, ""));
      const basic3 = Number(document.getElementById("basic3").innerText.replace(/,/g, ""));
      const basic4 = Number(document.getElementById("basic4").innerText.replace(/,/g, ""));
      const total_basic = basic1 + basic2 + basic3 + basic4;
  
      arrRetirement[17] = util.commaNum(total_basic);
  
      const bonus1 = Number(document.getElementById("bonus1").innerText.replace(/,/g, ""));
      const bonus2 = Number(document.getElementById("bonus1").innerText.replace(/,/g, ""));
      const bonus3 = Number(document.getElementById("bonus1").innerText.replace(/,/g, ""));
      const bonus4 = Number(document.getElementById("bonus1").innerText.replace(/,/g, ""));
      const total_bonus = bonus1 + bonus2 + bonus3 + bonus4;
      arrRetirement[18] = util.commaNum(total_bonus);
  
      const condition01 = total_basic + total_bonus;
      const condition02 = yearly * (3 / 12);
      const condition03 = annual * 5 * (3 / 12);
  
      const totalSum = Math.floor(util.round((condition01 + condition02 + condition03) / sumDate));
      arrRetirement[16] = util.commaNum(totalSum);
  
      const prediction = Math.floor(util.round(totalSum * 30 * (termDays / 365)));
      arrRetirement[15] = util.commaNum(prediction);
  
      return arrRetirement;
    },
    insurance: (salary, workers, accident) => {
      const pension_worker = salary.pension(salary);
      const pension_business = pension_worker;
      const pension_premium = pension_worker + pension_business;
  
      const health_worker = salary.health(salary);
      const health_business = health_worker;
      const health_premium = health_worker + health_business;
  
      const care_premium = salary.care(health_premium);
      const care_worker = care_premium / 2;
      const care_business = care_worker;
  
      let owner_total = 0;
      switch (workers) {
        case 0: owner_total = Math.floor((salary * GLOBAL_VALUE.EI_150L_OWNER) / 10) * 10 + Math.floor((salary * GLOBAL_VALUE.EI_UN_WORKER) / 10) * 10; break;
        case 1: owner_total = Math.floor((salary * GLOBAL_VALUE.EI_150H_OWNER) / 10) * 10 + Math.floor((salary * GLOBAL_VALUE.EI_UN_WORKER) / 10) * 10; break;
        case 3: owner_total = Math.floor((salary * GLOBAL_VALUE.EI_1000L_OWNER) / 10) * 10 + Math.floor((salary * GLOBAL_VALUE.EI_UN_WORKER) / 10) * 10; break;
        case 2: owner_total = Math.floor((salary * GLOBAL_VALUE.EI_1000H_OWNER) / 10) * 10 + Math.floor((salary * GLOBAL_VALUE.EI_UN_WORKER) / 10) * 10; break;
      }
  
      const worker_total = Math.floor((salary * GLOBAL_VALUE.EI_UN_WORKER) / 10) * 10;
      const accident_total = Math.floor((salary * accident) / 1000 / 10) * 10;
  
      return [
        util.commaNum(pension_worker), util.commaNum(pension_business), util.commaNum(pension_premium),
        util.commaNum(health_worker), util.commaNum(health_business), util.commaNum(health_premium),
        util.commaNum(care_worker), util.commaNum(care_business), util.commaNum(care_premium),
        util.commaNum(owner_total), util.commaNum(worker_total), util.commaNum(Math.floor((owner_total + worker_total) / 10) * 10),
        util.commaNum(accident_total)
      ];
    },
    pay: (severance, taxFreeLb, supportLb, annIncome) => {
      const division = 0;
      const support = Math.min(supportLb, 11);
      const minusPrice = (annIncome - taxFreeLb) / (severance === 0 ? 13 : 12);
      
      const salary_pension = salary.pension(minusPrice);
      const salary_health = salary.health(minusPrice);
      const salary_care = salary.care(salary_health);
      const salary_insurance = salary.insurance(minusPrice);
  
      const income_yearSalary = income.yearSalary(division, annIncome, taxFreeLb);
      const income_deduction = income.deduction(income_yearSalary);
      const income_amount = income.amount(income_yearSalary, income_deduction);
      const income_personal = income.personal(support);
      const income_pension = income.pension(income_yearSalary);
      const income_special = income.special(annIncome, support, income_yearSalary);
      const income_taxBase = income.taxBase(income_amount, income_personal, income_pension, income_special);
      const income_calculatedTax = income.calculatedTax(income_taxBase);
      const income_earned = income.earned(income_calculatedTax);
      const income_determinedTax = income.determinedTax(income_earned, income_calculatedTax);
      const income_simplifiedTax = income.simplifiedTax(income_determinedTax);
  
      const salary_localTax = salary.localTax(income_simplifiedTax);
      const salary_totalDeductible = salary.totalDeductible(salary_pension, salary_health, salary_care, salary_insurance, income_simplifiedTax, salary_localTax);
  
      const prediction = Math.floor((annIncome / (severance === 0 ? 13 : 12)) - salary_totalDeductible);
  
      return [
        util.commaNum(prediction), util.commaNum(salary_pension), util.commaNum(salary_health),
        util.commaNum(salary_care), util.commaNum(salary_insurance), util.commaNum(income_simplifiedTax),
        util.commaNum(salary_localTax), util.commaNum(salary_totalDeductible)
      ];
    },
    salary: (taxFreeLb, supportLb, annIncome) => {
      const division = 1;
      const support = Math.min(supportLb, 11);
      if (taxFreeLb > annIncome) return [];
  
      const minusPrice = annIncome - taxFreeLb;
      const salary_pension = salary.pension(minusPrice);
      const salary_health = salary.health(minusPrice);
      const salary_care = salary.care(salary_health);
      const salary_insurance = salary.insurance(minusPrice);
  
      const income_yearSalary = income.yearSalary(division, annIncome, taxFreeLb);
      const income_deduction = income.deduction(income_yearSalary);
      const income_amount = income.amount(income_yearSalary, income_deduction);
      const income_personal = income.personal(support);
      const income_pension = income.pension(income_yearSalary);
      const income_special = income.special(annIncome, support, income_yearSalary);
      const income_taxBase = income.taxBase(income_amount, income_personal, income_pension, income_special);
      const income_calculatedTax = income.calculatedTax(income_taxBase);
      const income_earned = income.earned(income_calculatedTax);
      const income_determinedTax = income.determinedTax(income_earned, income_calculatedTax);
      const income_simplifiedTax = income.simplifiedTax(income_determinedTax);
  
      const salary_localTax = salary.localTax(income_simplifiedTax);
      const salary_totalDeductible = salary.totalDeductible(salary_pension, salary_health, salary_care, salary_insurance, income_simplifiedTax, salary_localTax);
  
      const prediction = annIncome - salary_totalDeductible;
  
      return [
        util.commaNum(prediction), util.commaNum(salary_pension), util.commaNum(salary_health),
        util.commaNum(salary_care), util.commaNum(salary_insurance), util.commaNum(income_simplifiedTax),
        util.commaNum(salary_localTax), util.commaNum(salary_totalDeductible)
      ];
    },
    vatSum: totalSum => {
      const sumSupply = Math.round(totalSum / 1.1);
      const sumTax = totalSum - sumSupply;
      return [sumSupply, sumTax, sumSupply + sumTax];
    },
    vatSupplyPrice: supplyPrice => {
      const vatTax = Math.round(supplyPrice / 10);
      return [vatTax, supplyPrice + vatTax];
    }
  };
  

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