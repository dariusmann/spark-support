<template>
    <div>
        <div class="flex justify-between">
            <h2 class="pl-6 pt-6 text-xl font-semibold text-gray-700">
                {{ trans(plan.name) }}
            </h2>

            <div class="h-1/2 px-4 py-1 bg-gray-200 text-gray-700 text-sm font-semibold rounded-bl-md"
                 v-if="! hideIncentive && ((plan.incentive.monthly && plan.interval === 'monthly') ||
                              (plan.incentive.yearly && plan.interval === 'yearly'))">
                {{ trans(plan.incentive[plan.interval]) }}
            </div>
        </div>

        <div class="px-6 pb-6">
            <div class="mt-2 text-md font-semibold text-gray-700">
                <span v-html="plan.price"></span>
                <span v-if="$page.props.collectsVat">({{ trans('ex VAT') }})</span>
                <template v-if="seatName"> / {{ trans(seatName) }} / {{ trans(plan.interval) }}</template>
                <template v-else>/ {{ trans(plan.interval) }}</template>
                <span class="text-gray-400" v-if="plan.trial_days"> ({{ trans(':days day trial', {days: plan.trial_days })}})</span>
            </div>

            <div class="mt-3 space-y-2">
                <div class="flex items-center" v-for="feature in plan.features">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="text-green-400 opacity-75 inline-block flex-shrink-0 w-5 h-5">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>

                    <div class="ml-2 text-sm text-gray-600">
                        {{ trans(feature) }}
                    </div>
                </div>
            </div>

            <div class="mt-3 text-xs text-gray-500" v-if="collectionMethod">
                <span v-if="collectionMethod === 'send_invoice'" class="flex justify-items-center">
                    <email-icon class="inline-block mr-1 w-4 h-4" />
                    {{ trans('You will receive an invoice and payment link via email for each billing period.') }}
                </span>

                <span v-if="collectionMethod === 'charge_automatically'" class="flex justify-items-center">
                    <repeat-icon class="inline-block mr-1 w-4 h-4" />
                    {{ trans('Your payment method will be charged automatically for each billing period.') }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>

import { trans } from 'laravel-vue-i18n';
import EmailIcon from "@/Icons/EmailIcon.vue";
import RepeatIcon from "@/Icons/RepeatIcon.vue";

export default {
    methods: {trans},
    components: {RepeatIcon, EmailIcon},

    props: ['plan', 'collectionMethod', 'seatName', 'hideIncentive'],
}
</script>
