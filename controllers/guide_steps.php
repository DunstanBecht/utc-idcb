<?php
/**
 * This file defines the tree.
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
  '1'=>'test_1',
  '2a'=>'test_2',
  '2b'=>'test_3',
  '3'=>'test_4',
));

# Form ---------------------------------------------------------------------- #
