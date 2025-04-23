import { computed , isRef} from "vue"

export const useMonthlyPayment = (price,interestRate,duration) => {
  const principle = isRef(price) ? price.value : price 
    const monthlyPayment = computed(()=>{

         const monthlyInterest = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12
         const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration) * 12  
         return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
       })
    
    const totalPaid = computed(()=> (monthlyPayment.value * 12 * (isRef(duration) ? duration.value : duration)) ) 

    const interestPaid = computed( ()=> ( totalPaid.value -  ( isRef(principle) ? principle.value : principle ) ) ) 

   return {monthlyPayment,totalPaid,interestPaid}
}

