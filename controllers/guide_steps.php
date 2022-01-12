<?php
/**
 * This file defines the tree.
 * @author Charline Level <charline.level@etu.utc.fr>
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers\steps;

# Entry point --------------------------------------------------------------- #

new Radio('medical_device', array(
  'md_criterion_1'=>'software',
  'md_criterion_2'=>'software',
  'md_criterion_3'=>'software',
  'md_criterion_4'=>'software',
  'md_criterion_5'=>'software',
  'md_criterion_6'=>'software',
));

# Determination of the class ------------------------------------------------ #

new Define('class_1',  'class', '1',  'ce_marked');
new Define('class_2a', 'class', '2a', 'ce_marked');
new Define('class_2b', 'class', '2b', 'ce_marked');
new Define('class_3',  'class', '3',  'ce_marked');

new Radio('software', array(
  'yes'=>'support_for_therapeutic_or_diagnostic_decisions',
  'no'=>'active_device',
));

new Radio('support_for_therapeutic_or_diagnostic_decisions', array(
  'yes'=>'possible_death_or_irreversible_deterioration',
  'no'=>'repair_lamp',
));

new Radio('possible_death_or_irreversible_deterioration', array(
  'yes'=>'class_3',
  'no'=>'possible_deterioration_but_not_death',
));

new Radio('possible_deterioration_but_not_death', array(
  'yes'=>'class_2b',
  'no'=>'class_2a',
));

new Radio('active_device', array(
  'yes'=>'active_therapeutic_device',
  'no'=>'invasive',
));

new Radio('active_therapeutic_device', array(
  'yes'=>'usage',
  'no'=>'diagnosis_and_control',
));

new Radio('usage', array(
  'command_or_control_action_on_AIMD'=>'class_3',
  'supply_or_transfer_of_energy'=>'class_2b',
  'ionizing_emitter'=>'class_2b',
  'other'=>'class_2a',
));

new Radio('diagnosis_and_control', array(
  'yes'=>'vital_diagnosis_and_controls_for_immediate_danger',
  'no'=>'administration_withdrawal_of_drugs_liquids_or_substances',
));

new Radio('danger_administration_withdrawal_of_drugs_liquids_or_substances', array(
  'yes'=>'class_2b',
  'no'=>'class_2a',
));

new Radio('vital_diagnosis_and_controls_for_immediate_danger', array(
  'yes'=>'class_2b',
  'no'=>'class_2a',
));

new Radio('invasive', array(
  'yes'=>'invasive_way',
  'no'=>'conduction_or_storage_of_biological_fluid',
));

new Radio('conduction_or_storage_of_biological_fluid', array(
  'yes'=>'blood_bag',
  'no'=>'modification_of_the_biological_or_chemical_composition_of_the_body',
));

new Radio('blood_bag', array(
  'yes'=>'class_2b',
  'no'=>'class_2a',
));

new Radio('modification_of_the_biological_or_chemical_composition_of_the_body', array(
  'yes'=>'filtration_in_the_presence_of_gas',
  'no'=>'contact_with_injured_skin',
));

new Radio('filtration_in_the_presence_of_gas', array(
  'yes'=>'class_2a',
  'no'=>'class_2b',
));

new Radio('contact_with_injured_skin', array(
  'yes'=>'wound_that_involves_the_destruction_of_the_dermis',
  'no'=>'class_1',
));

new Radio('wound_that_involves_the_destruction_of_the_dermis', array(
  'yes'=>'class_2b',
  'no'=>'mechanical_barrier',
));

new Radio('mechanical_barrier', array(
  'yes'=>'class_1',
  'no'=>'class_2a',
));

new Radio('invasive_way', array(
  'natural_orifice'=>'inhalation',
  'surgical'=>'duration_surgical',
));

new Radio('inhalation', array(
  'yes'=>'drug_have_an_impact_on_the_vital_prognosis',
  'no'=>'duration_inhalation',
));

new Radio('drug_have_an_impact_on_the_vital_prognosis', array(
  'yes'=>'class_2b',
  'no'=>'class_2a',
));

new Radio('duration_inhalation', array(
  'temporary_continuous_for_less_than_60min'=>'class_1',
  'short_continuous_between_60min_and_30days'=>'short_application_in_the_oral_nasal_or_auditory_cavity',
  'long_continuous_for_more_than_30days'=>'long_application_in_the_oral_nasal_or_auditory_cavity',
));

new Radio('short_application_in_the_oral_nasal_or_auditory_cavity', array(
  'yes'=>'class_1',
  'no'=>'class_2a',
));

new Radio('long_application_in_the_oral_nasal_or_auditory_cavity', array(
  'yes'=>'class_2a',
  'no'=>'class_2b',
));

new Radio('duration_surgical', array(
  'temporary_continuous_for_less_than_60min'=>'reusable',
  'short_continuous_between_60min_and_30days'=>'usage_surgical_short',
  'long_continuous_for_more_than_30days'=>'usage_surgical_long',
));

new Radio('usage_surgical_long', array(
  'implanted_in_the_teeth'=>'class_2a',
  'direct_contact_with_the_CNS_or_the_CSC_or_the_heart'=>'class_3',
  'biological_effect_on_the_organism'=>'class_3',
  'induces_a_chemical_transformation_in_the_body'=>'class_3',
  'allows_the_administration_of_medication'=>'class_3',
  'active_implantable_medical_devices_AIMD'=>'class_3',
  'implants_eg_breast_implants'=>'class_3',
  'joint_or_disc_prostheses'=>'class_3',
));

new Radio('reusable', array(
  'yes'=>'class_1',
  'no'=>'class_2a',
));

new Radio('usage_surgical_short', array(
  'control_monitoring_function_for_heart_and_CSC_diagnosis_by_direct_contact'=>'class_2b',
  'direct_contact_with_the_CNS'=>'class_2b',
  'ionizing_radiation'=>'class_3',
  'biological_effect_on_the_human_body'=>'class_3',
  'administration_of_risky_drugs'=>'class_3',
));

# Definition of the clinical strategy --------------------------------------- #

new Radio('ce_marked', array(
  'yes'=>'is_class_3',
  'no'=>'innovative_device',
));

new Match('is_class_3', 'class', array(
  '1'=>'is_implantable',
  '2a'=>'is_implantable',
  '2b'=>'is_implantable',
  '3'=>'is_it_clinically_equivalent',
));

new Match('is_implantable', 'implantable', array(
  NULL=>'strategy_1_a',
  'yes'=>'is_it_clinically_equivalent',
));

new Radio('is_it_clinically_equivalent', array(
  'yes'=>'is_it_technically_equivalent',
  'no'=>'strategy_1_a'
));

new Radio('is_it_technically_equivalent', array(
  'yes'=>'is_it_equivalent_at_the_biological_level',
  'no'=>'strategy_1_a'
));

new Radio('is_it_equivalent_at_the_biological_level', array(
  'yes'=>'device_belongs_to_the_following_list',
  'no'=>'strategy_1_a'
));

new Radio('device_belongs_to_the_following_list', array(
  'yes'=>'clinical_evaluation_based_on_sufficient_clinical_data',
  'no'=>'marketed_device_made_by_the_same_manufacturer?'
));

new Radio('clinical_evaluation_based_on_sufficient_clinical_data', array(
  'yes'=>'clinical_evaluation_is_in_accordance_with_the_common_product_specification',
  'no'=>'strategy_4_a'
));

new Radio('clinical_evaluation_is_in_accordance_with_the_common_product_specification', array(
  'yes'=>'strategy_6_a',
  'no'=>'strategy_4_a'
));

new Radio('marketed_device_made_by_the_same_manufacturer', array(
  'yes'=>'manufacturer_demonstrated_device_is_equivalent_to_the_marketed_device',
  'no'=>'both_manufacturers_have_signed_a_contract',
));

new Radio('manufacturer_demonstrated_device_is_equivalent_to_the_marketed_device', array(
  'yes'=>'clinical_evaluation_of_the_marketed_device_sufficient_to_demonstrate_compliance_of_the_modified_device',
  'no'=>'strategy_4_a'
));

new Radio('clinical_evaluation_of_the_marketed_device_sufficient_to_demonstrate_compliance_of_the_modified_device', array(
  'yes'=>'strategy_5_a',
  'no'=>'strategy_4_a'
));

new Radio('both_manufacturers_have_signed_a_contract', array(
  'yes'=>'original_clinical_evaluation_performed_in_accordance_with_the_requirements_of_regulation_eu_2017_745?',
  'no'=>'strategy_4_a',
));

new Radio('original_clinical_evaluation_performed_in_accordance_with_the_requirements_of_regulation_eu_2017_745', array(
  'yes'=>'strategy_6_a',
  'no'=>'strategy_4_a',
));

new Radio('innovative_device', array(
  'yes'=>'strategy_2_a',
  'no'=>'older_generations_of_products',
));

new Radio('older_generations_of_products', array(
  'yes'=>'strategy_3_a',
  'no'=>'equivalent_devices_already_on_the_market',
));

new Radio('equivalent_devices_already_on_the_market', array(
  'yes'=>'strategy_3_a',
  'no'=>'enough_data_in_the_literature',
));

new Radio('enough_data_in_the_literature', array(
  'yes'=>'strategy_3_a',
  'no'=>'strategy_4_a',
));

/*
 * Strategy 1:
 * - Réaliser un état de l'art des nouveauté: DM similiares apparus, autres traitements, nouveaux diagnostiques, ...
 * - Critères de sécurité et de performances
 * - Justification bénéfice clinique
 * - Liste bibliographique
 * - Plan d'évaluation clinique
 */
new Define('strategy_1_a',  'required_state_of_the_art', 'yes', 'strategy_1_b');
new Define('strategy_1_b',  'required_safety_and_performance_criteria', 'yes', 'strategy_1_c');
new Define('strategy_1_c',  'required_clinical_benefit_justification', 'yes', 'strategy_1_d');
new Define('strategy_1_d',  'required_bibliographic_list', 'yes', 'strategy_1_e');
new Define('strategy_1_e',  'required_clinical_evaluation_plan', 'yes', 'clinical_evaluation_report');

/*
 * Strategy 2:
 * - Plan d'évaluation clinique
 * - Investigation clinique
 */
new Define('strategy_2_a',  'required_clinical_evaluation_plan', 'yes', 'strategy_2_b');
new Define('strategy_2_b',  'required_clinical_investigation', 'yes', 'clinical_evaluation_report');

/*
 * Strategy 3:
 * - Procédure d'équivalence
 */
new Define('strategy_3_a',  'required_equivalence_procedure', 'yes', 'clinical_evaluation_report');

/*
 * Strategy 4:
 * - Investigation clinique
 */
new Define('strategy_4_a',  'required_clinical_investigation', 'yes', 'clinical_evaluation_report');

/*
 * Strategy 5:
 * - Procédure d'équivalence
 * - Plan du SCAC doit être approprié et inclut des études après commercialisation pour démontrer la sécurité et les performances du dispositif
 */
new Define('strategy_5_a',  'required_equivalence_procedure', 'yes', 'strategy_5_b');
new Define('strategy_5_b',  'required_scac', 'yes', 'clinical_evaluation_report');

/*
 * Strategy 6:
 * - Procédure d'équivalence
 * - Le fabricant doit justifier sa décision de ne pas conduire des investigations cliniques dans le rapport d'évaluation clinique
 */
new Define('strategy_6_a',  'required_equivalence_procedure', 'yes', 'strategy_6_b');
new Define('strategy_6_b',  'required_justify_no_clinical_investigation', 'yes', 'clinical_evaluation_report');

# Form ---------------------------------------------------------------------- #

new Leaf('clinical_evaluation_report', 'views/pages/guide/report.php');
