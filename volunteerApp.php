<?php $formData = $formData ?? $_POST ?? []; ?>

<!-- General Volunteer application -->

<h1>Volunteer Application</h1>
<main class="signup-form">
    <form class="signup-form" method="post">
        <h2>Application</h2>
        <p>Please fill out each section of the following form if you would like to volunteer for NAMI Rappahannock.</p>
        <p>An asterisk (<em>*</em>) indicates a required field.</p>

        <fieldset class="section-box">
            <legend>Personal Information</legend>

            <p>The following information will help us identify you within our system.</p>
            <label for="first_name"><em>* </em>First Name</label>
            <input type="text" id="first_name" name="first_name" required placeholder="Enter your first name" value="<?= htmlspecialchars($formData['first_name'] ?? '') ?>">

            <label for="last_name"><em>* </em>Last Name</label>
            <input type="text" id="last_name" name="last_name" required placeholder="Enter your last name" value="<?= htmlspecialchars($formData['last_name'] ?? '') ?>">

            <label for="birthday"><em>* </em>Date of Birth</label>
            <input type="date" id="birthday" name="birthday" required placeholder="Choose your birthday" max="<?php echo date('Y-m-d'); ?>">

            <label for="phone"><em>* </em>Best number to reach you?</label>
            <input type="tel" id="phone" name="phone" pattern="\([0-9]{3}\) [0-9]{3}-[0-9]{4}" required placeholder="Ex. (555) 555-5555" value="<?= htmlspecialchars($formData['phone'] ?? '') ?>">

            <label><em>* </em>May we text this number?</label>
            <div class="radio-group">
                <input type="radio" id="yes_text" name="text" value="yes_text" <?= ($formData['text'] ?? '') === 'yes_text' ? 'checked' : '' ?>><label for="yes_text">Yes</label>
                <input type="radio" id="no_text" name="text" value="no_text" <?= ($formData['text'] ?? '') === 'no_text' ? 'checked' : '' ?>><label for="no_text">No</label>
                <input type="radio" id="text_na" name="text" value="text_na" <?= ($formData['text'] ?? '') === 'text_na' ? 'checked' : '' ?>><label for="text_na">N/A</label>
            </div>

            <label><em>* </em>Email Address</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($formData['email'] ?? '') ?>">

            <label for="street_address"><em>* </em>Street Address</label>
            <input type="text" id="street_address" name="street_address" required placeholder="Enter your street address" value="<?= htmlspecialchars($formData['street_address'] ?? '') ?>">

            <label for="city"><em>* </em>City</label>
            <input type="text" id="city" name="city" required placeholder="Enter your city" value="<?= htmlspecialchars($formData['city'] ?? '') ?>">

            <label for="state"><em>* </em>State</label>
            <select id="state" name="state" required>
                <?php
                $states = [
                    'AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut',
                    'DE'=>'Delaware','DC'=>'District Of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois',
                    'IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts',
                    'MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada',
                    'NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota',
                    'OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota',
                    'TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VA'=>'Virginia','VT'=>'Vermont','WA'=>'Washington','WV'=>'West Virginia',
                    'WI'=>'Wisconsin','WY'=>'Wyoming'
                ];
                $selectedState = $formData['state'] ?? '';
                foreach ($states as $abbr => $name) {
                    $selected = ($abbr === $selectedState) ? 'selected' : '';
                    echo "<option value=\"$abbr\" $selected>$name</option>";
                }
                ?>
            </select>

            <label for="zip"><em>* </em>Zip Code</label>
            <input type="text" id="zip" name="zip" pattern="[0-9]{5}" title="5-digit zip code" required placeholder="Enter your 5-digit zip code" value="<?= htmlspecialchars($formData['zip'] ?? '') ?>">
        </fieldset>

        <fieldset class="section-box">
                <legend>Emergency Contact Information</legend>
            <label for="emergency_contact_first_name"><em>* </em>Emergency Contact First Name</label>
            <input type="text" id="emergency_contact_first_name" name="emergency_contact_first_name" required placeholder="Enter your emergency contact's first name" value="<?= htmlspecialchars($formData['emergency_contact_first_name'] ?? '') ?>">

            <label for="emergency_contact_last_name"><em>* </em>Emergency Contact Last Name</label>
            <input type="text" id="emergency_contact_last_name" name="emergency_contact_last_name" required placeholder="Enter your emergency contact's last name" value="<?= htmlspecialchars($formData['emergency_contact_last_name'] ?? '') ?>">

            <label for="emergency_contact_relation"><em>* </em>Emergency Contact relation</label>
            <input type="text" id="emergency_contact_relation" name="emergency_contact_relation" required placeholder="Enter your emergency contact's relation" value="<?= htmlspecialchars($formData['emergency_contact_relation'] ?? '') ?>">

            <label for="emergency_contact_phone"><em>* </em>Best number to reach your emergency contact?</label>
            <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" pattern="\([0-9]{3}\) [0-9]{3}-[0-9]{4}" required placeholder="Ex. (555) 555-5555" value="<?= htmlspecialchars($formData['emergency_contact_phone'] ?? '') ?>">

        </fieldset>

        <fieldset class="section-box">
            <legend>NAMIRAPP Specific Questions</legend>

            <label for="strengths_and_weaknesses"><em>* </em>List three strengths and three areas you could improve upon</label>
            <input type="text" id="strengths_and_weaknesses" name="strengths_and_weaknesses" value="<?= htmlspecialchars($formData['strengths_and_weaknesses'] ?? '') ?>">

            <p><em>* </em>The list below shows the primary roles of our volunteers in NAMIRAPP. Please select the role that would be the best fit for you from the list below</p>
            <div class="radio-group">
                <?php
                $roles = ['group','marketing','presenting','organizing','fundraising','managing','teaching','helping','charting'];
                foreach ($roles as $role) {
                    $checked = ($formData['primary_role'] ?? '') === $role ? 'checked' : '';
                    echo "<input type='radio' id='primary_role_$role' name='primary_role' value='$role' required $checked><label for='primary_role_$role'>" . ucfirst($role) . "</label><br>";
                }
                ?>
            </div>

            <label><em>* </em>Do you work best:</label>
            <div class="radio-group">
                <?php
                foreach (['self', 'shadow', 'unsure'] as $option) {
                    $checked = ($formData['work_best'] ?? '') === $option ? 'checked' : '';
                    echo "<input type='radio' id='work_best_$option' name='work_best' value='$option' required $checked><label for='work_best_$option'>" . ucfirst($option) . "</label><br>";
                }
                ?>
            </div>

            <label><em>* </em>Which form of communication fits best as your preference to communicate to others?</label>
            <div class="radio-group">
                <?php
                foreach (['verbal', 'written', 'either'] as $comm) {
                    $checked = ($formData['communication'] ?? '') === $comm ? 'checked' : '';
                    echo "<input type='radio' id='communication_$comm' name='communication' value='$comm' required $checked><label for='communication_$comm'>" . ucfirst($comm) . "</label>";
                }
                ?>
            </div>

            <label><em>* </em>How do you best learn new information?</label>
            <div class="radio-group">
                <?php
                foreach (['visual', 'audiotory', 'kinesthetic'] as $learn) {
                    $checked = ($formData['learning'] ?? '') === $learn ? 'checked' : '';
                    echo "<input type='radio' id='learning_$learn' name='learning' value='$learn' required $checked><label for='learning_$learn'>" . ucfirst($learn) . "</label>";
                }
                ?>
            </div>

            <label><em>* </em>Do you consider yourself to be:</label>
            <div class="radio-group">
                <input type="radio" id="personality_intro" name="personality" value="intro" <?= ($formData['personality'] ?? '') === 'intro' ? 'checked' : '' ?> required><label for="personality_intro">Introverted</label>
                <input type="radio" id="personality_extro" name="personality" value="extro" <?= ($formData['personality'] ?? '') === 'extro' ? 'checked' : '' ?> required><label for="personality_extro">Extroverted</label>
            </div>

            <label><em>* </em>Do you or someone in your immediate family suffer from mental illness?</label>
            <div class="radio-group">
                <input type="radio" id="mental_illness_yes" name="mental_illness" value="yes" <?= ($formData['mental_illness'] ?? '') === 'yes' ? 'checked' : '' ?> required><label for="mental_illness_yes">Yes</label>
                <input type="radio" id="mental_illness_no" name="mental_illness" value="no" <?= ($formData['mental_illness'] ?? '') === 'no' ? 'checked' : '' ?> required><label for="mental_illness_no">No</label>
            </div>

            <label for="why_volunteer"><em>* </em>Why do you want to volunteer?</label>
            <input type="text" id="why_volunteer" name="why_volunteer" value="<?= htmlspecialchars($formData['why_volunteer'] ?? '') ?>">

            <label for="additional_interest"><em>* </em>Are you interested in specific volunteer roles?</label>
            <div class="radio-group">
                <input type="radio" id="additional_interest_yes" name="additional_interest" value="yes" <?= ($formData['additional_interest'] ?? '') === 'yes' ? 'checked' : '' ?> required><label for="additional_interest_yes">Yes</label>
                <input type="radio" id="additional_interest_no" name="additional_interest" value="no" <?= ($formData['additional_interest'] ?? '') === 'no' ? 'checked' : '' ?> required><label for="additional_interest_no">No</label>
            </div>

            <fieldset class="section-box" id="additional_info_section" style="display: none;">
                <label for="activePayingNamiAffiliate"><em>* </em>Are you a paying member?</label>
                <div class="radio-group">
                    <input type="radio" id="activePayingNamiAffiliate_yes" name="activePayingNamiAffiliate" value="yes" <?= ($formData['activePayingNamiAffiliate'] ?? '') === 'yes' ? 'checked' : '' ?>><label for="activePayingNamiAffiliate_yes">Yes</label>
                    <input type="radio" id="activePayingNamiAffiliate_no" name="activePayingNamiAffiliate" value="no" <?= ($formData['activePayingNamiAffiliate'] ?? '') === 'no' ? 'checked' : '' ?>><label for="activePayingNamiAffiliate_no">No</label>
                </div>

                <label for="ifNotAreWilling"><em>* </em>If not, are you willing to join?</label>
                <div class="radio-group">
                    <input type="radio" id="ifNotAreWilling_yes" name="ifNotAreWilling" value="yes" <?= ($formData['ifNotAreWilling'] ?? '') === 'yes' ? 'checked' : '' ?>><label for="ifNotAreWilling_yes">Yes</label>
                    <input type="radio" id="ifNotAreWilling_no" name="ifNotAreWilling" value="no" <?= ($formData['ifNotAreWilling'] ?? '') === 'no' ? 'checked' : '' ?>><label for="ifNotAreWilling_no">No</label>
                </div>

                <label for="choiceNamiAffiliate"><em>* </em>Which NAMI affiliate?</label>
                <input type="text" id="choiceNamiAffiliate" name="choiceNamiAffiliate" value="<?= htmlspecialchars($formData['choiceNamiAffiliate'] ?? '') ?>">
            </fieldset>
        </fieldset>

        <fieldset class="section-box">
                <legend>Extra Information</legend>
            <label for="disability_accomodation_needs"><em>* </em>Do you have an accomodation needs?</label>
            <input type="text" id="disability_accomodation_needs" name="disability_accomodation_needs" required placeholder="" value="<?= htmlspecialchars($formData['disability_accomodation_needs'] ?? '') ?>">

            <label for="professional_experience"><em>* </em>Do you have any professional experience?</label>
            <input type="text" id="professional_experience" name="professional_experience" required placeholder="" value="<?= htmlspecialchars($formData['professional_experience'] ?? '') ?>">
            
            <label for="hobbies"><em>* </em>Do you have any hobbies?</label>
            <input type="text" id="hobbies" name="hobbies" required placeholder="" value="<?= htmlspecialchars($formData['hobbies'] ?? '') ?>">

            <label for="how_you_heard_of_stepva"><em>* </em>How did you hear about NAMI Rappahannock?</label>
            <input type="text" id="how_you_heard_of_stepva" name="how_you_heard_of_stepva" required placeholder="" value="<?= htmlspecialchars($formData['how_you_heard_of_stepva'] ?? '') ?>">

        </fieldset>

        <fieldset class="section-box">
            <legend>Login Credentials</legend>

            <label for="username"><em>* </em>Username</label>
            <input type="text" id="username" name="username" required placeholder="Enter a username" value="<?= htmlspecialchars($formData['username'] ?? '') ?>">

            <label for="password"><em>* </em>Password</label>
            <input type="password" id="password" name="password" placeholder="Enter a strong password" required>

            <label for="password-reenter"><em>* </em>Re-enter Password</label>
            <input type="password" id="password-reenter" name="password-reenter" placeholder="Re-enter password" required>
        
            <label for="verification_code"><em>* </em>Verification Code</label>
            <input type="text" id="verification_code" name="verification_code"  placeholder="Enter the code sent to your email" value="<?= htmlspecialchars($formData['verification_code'] ?? '') ?>">
            </fieldset>

        
        <p> send code to verify email address</p>    
        <button type="submit" name="send_code">Send Verification Code</button>

        <p>By pressing Submit below, you are agreeing to volunteer for the organization.</p>
        <input type="submit" name="registration-form" value="Submit">
    </form>
</main>

<script>
function toggleSpecificQuestions() {
    const yes = document.getElementById('additional_interest_yes');
    const section = document.getElementById('additional_info_section');
    section.style.display = yes.checked ? "block" : "none";
}
document.getElementById('additional_interest_yes').addEventListener('change', toggleSpecificQuestions);
document.getElementById('additional_interest_no').addEventListener('change', toggleSpecificQuestions);
toggleSpecificQuestions();
</script>
