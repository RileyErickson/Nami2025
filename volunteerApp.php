
<!-- General Volunteer application -->

<h1>Volunteer application</h1>
<main class="signup-form">
    <form class="signup-form" method="post">
        <h2>application</h2>
        <p>Please fill out each section of the following form if you would like to volunteer for NAMI Rappahannock.</p>
        <p>An asterisk (<em>*</em>) indicates a required field.</p>
        
        <fieldset class="section-box">
            <legend>Personal Information</legend>

            <p>The following information will help us identify you within our system.</p>
            <label for="first_name"><em>* </em>First Name</label>
            <input type="text" id="first_name" name="first_name" required placeholder="Enter your first name">

            <label for="last_name"><em>* </em>Last Name</label>
            <input type="text" id="last_name" name="last_name" required placeholder="Enter your last name">

            <label for="phone"><em>* </em>Best number to reach you?</label>
            <input type="tel" id="phone" name="phone" pattern="\([0-9]{3}\) [0-9]{3}-[0-9]{4}" required placeholder="Ex. (555) 555-5555">

            <label><em>* </em>May we text this number?</label>
            <div class="radio-group">
                <input type="radio" id="yes_text" name="text" value="yes_text" required><label for="yes_text">Yes</label>
                <input type="radio" id="no_text" name="text" value="no_text" required><label for="no_text">No</label>
                <input type="radio" id="text_na" name="text" value="text_na" required><label for="text_na">N/A</label>
            </div>

            <label><em>* </em>Email Address</label>
            <input type="text" id="email" name="email">
            
            <label for="street_address"><em>* </em>Street Address</label>
            <input type="text" id="street_address" name="street_address" required placeholder="Enter your street address">

            <label for="city"><em>* </em>City</label>
            <input type="text" id="city" name="city" required placeholder="Enter your city">

            <label for="state"><em>* </em>State</label>
            
            <select id="state" name="state" required>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA" selected>Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>

            <label for="zip"><em>* </em>Zip Code</label>
            <input type="text" id="zip" name="zip" pattern="[0-9]{5}" title="5-digit zip code" required placeholder="Enter your 5-digit zip code">
        </fieldset>

        <fieldset class="section-box">
            <legend>NAMIRAPP Specific Questions</legend>

            <p>The following information will help us get a better understanding of who you are and why you may be a good fit to volunteer at NAMIRAPP.</p>
            <label for="strengths_and_weaknesses"><em>* </em>List three strengths and three areas you could improve upon</label>
            <input type="text" id="strengths_and_weaknesses" name="strengths_and_weaknesses">

            <p><em>* </em>The list below shows the primary roles of our volunteers in NAMIRAPP. Please select the role that would be the best fit for you from the list below</p>
            <div class="radio-group">
                <input type="radio" id="primary_role_group" name="primary_role" value="group" required><label for="primary_role_group">Overseeing a Group</label><br>
                <input type="radio" id="primary_role_marketing" name="primary_role" value="marketing" required><label for="primary_role_marketing">Social Media and/or Marketing</label><br>
                <input type="radio" id="primary_role_presenting" name="primary_role" value="presenting" required><label for="primary_role_presenting">Presenting to a Group or Public Speaking</label><br>
                <input type="radio" id="primary_role_organizing" name="primary_role" value="organizing" required><label for="primary_role_organizing">Organizing Community or Holiday Events</label><br>
                <input type="radio" id="primary_role_fundraising" name="primary_role" value="fundraising" required><label for="primary_role_fundraising">Fundraising</label><br>
                <input type="radio" id="primary_role_managing" name="primary_role" value="managing" required><label for="primary_role_managing">Managing a Team</label><br>
                <input type="radio" id="primary_role_teaching" name="primary_role" value="teaching" required><label for="primary_role_teaching">Teaching a Class</label><br>
                <input type="radio" id="primary_role_helping" name="primary_role" value="helping" required><label for="primary_role_helping">Helping Members of the Community via Phone Calls or Emails</label><br>
                <input type="radio" id="primary_role_charting" name="primary_role" value="charting" required><label for="primary_role_charting">Charting Legislation or Policies Impacting Mental Health</label>
            </div>

            <label><em>* </em>Do you work best:</label>
            <div class="radio-group">
                <input type="radio" id="work_best_self" name="work_best" value="self" required><label for="work_best_self">As a self starter (able to take off on your own)</label><br>
                <input type="radio" id="work_best_shadow" name="work_best" value="shadow" required><label for="work_best_shadow">Shadowing someone until you understand the role</label><br>
                <input type="radio" id="work_best_unsure" name="work_best" value="unsure" required><label for="work_best_unsure">Not sure / Never thought of it</label><br>
            </div>

            <label><em>* </em>Which form of communication fits best as your preference to communicate to others?</label>
            <div class="radio-group">
                <input type="radio" id="communication_verbal" name="communication" value="verbal" required><label for="communication_verbal">Verbal</label>
                <input type="radio" id="communication_written" name="communication" value="written" required><label for="communication_written">Written</label>
                <input type="radio" id="communication_either" name="communication" value="either" required><label for="communication_either">Either</label>
            </div>

            <label><em>* </em>How do you best learn new information?</label>
            <div class="radio-group">
                <input type="radio" id="learning_visual" name="learning" value="visual" required><label for="learning_visual">Visuals</label>
                <input type="radio" id="learning_audiotory" name="learning" value="audiotory" required><label for="learning_audiotory">Audiotory</label>
                <input type="radio" id="learning_kinesthetic" name="learning" value="kinesthetic" required><label for="learning_kinesthetic">Kinesthetic (hands on)</label>
            </div>

            <label><em>* </em>Do you consider yourself to be:</label>
            <div class="radio-group">
                <input type="radio" id="personality_intro" name="personality" value="intro" required><label for="personality_intro">Introverted</label>
                <input type="radio" id="personality_extro" name="personality" value="extro" required><label for="personality_extro">Extroverted</label>
            </div>
            
            <label><em>* </em>Do you or someone in your immediate family suffer from mental illness?</label>
            <div class="radio-group">
                <input type="radio" id="mental_illness_yes" name="mental_illness" value="yes" required><label for="mental_illness_yes">Yes</label>
                <input type="radio" id="mental_illness_no" name="mental_illness" value="no" required><label for="mental_illness_no">No</label>
            </div>

            <label for="why_volunteer"><em>* </em>Why do you want to volunteer with NAMI Rappahannock or an organization in the mental health sector? if you have an impactful story, please elaborate!</label>
            <input type="text" id="why_volunteer" name="why_volunteer">

            <label for="additional_interest"><em>* </em>Are you interested in volunteering as any of the following: Family Support Group Facilitator, Connection Support Group Facilitator, Peer-to-Peer Teacher, In Our Own Voice Presenter, Homefront Teacher, Family-to-Family Teacher</label>
            <div class="radio-group">
                <input type="radio" id="additional_interest_yes" name="additional_interest" value="yes" required><label for="additional_interest_yes">Yes</label>
                <input type="radio" id="additional_interest_no" name="additional_interest" value="no" required><label for="additional_interest_no">No</label>
            </div>

            <fieldset class="section-box" id="additional_info_section" style="display: none;">
            <label for="activePayingNamiAffiliate"><em>* </em>Are you an active, dues-paying member of a local NAMI affiliate?</label>
            <div class="radio-group">
                <input type="radio" id="activePayingNamiAffiliate_yes" name="activePayingNamiAffiliate" value="yes"><label for="activePayingNamiAffiliate_yes">Yes</label>
                <input type="radio" id="activePayingNamiAffiliate_no" name="activePayingNamiAffiliate" value="no"><label for="activePayingNamiAffiliate_no">No</label>
            </div>

            <label for="ifNotAreWilling"><em>* </em>If not, are you willing to join?</label>
            <div class="radio-group">
                <input type="radio" id="ifNotAreWilling_yes" name="ifNotAreWilling" value="yes"><label for="ifNotAreWilling_yes">Yes</label>
                <input type="radio" id="ifNotAreWilling_no" name="ifNotAreWilling" value="no"><label for="ifNotAreWilling_no">No</label>
            </div>

            <label for="choiceNamiAffiliate"><em>* </em>Which NAMI affiliate are you a member of (or planning to join)?</p>
            <input type="text" id="choiceNamiAffiliate" name="choiceNamiAffiliate">
            </fieldset>

        </fieldset>

        <script>

            function toggleSpecificQuestions() {
                // Get the value of the hidden input field
                const additional_interest_yes = document.getElementById('additional_interest_yes');
                const additional_interest_no = document.getElementById('additional_interest_no');
                const additional_info_section = document.getElementById('additional_info_section');

                if (additional_interest_yes.checked) {
                    additional_info_section.style.display = "block";
                } else {
                    additional_info_section.style.display = "none";
                }
            }

            document.getElementById('additional_interest_yes').addEventListener('change', toggleSpecificQuestions);
            document.getElementById('additional_interest_no').addEventListener('change', toggleSpecificQuestions);

            toggleSpecificQuestions();

        </script>

        <fieldset class="section-box">
            <legend>Login Credentials</legend>
            
            <p>You will use the following information to log in to the system.</p>

            <label for="username"><em>* </em>Username</label>
            <input type="text" id="username" name="username" required placeholder="Enter a username">

            <label for="password"><em>* </em>Password</label>
            <input type="password" id="password" name="password" placeholder="Enter a strong password" required>
            <p id="password-error" class="error hidden">Password needs to be at least 8 characters long, contain at least one number, one uppercase letter, and one lowercase letter!</p>

            <label for="password-reenter"><em>* </em>Re-enter Password</label>
            <input type="password" id="password-reenter" name="password-reenter" placeholder="Re-enter password" required>
            <p id="password-match-error" class="error hidden">Passwords do not match!</p>
        </fieldset>
        <p>By pressing Submit below, you are agreeing to volunteer for the organization.</p>
        <input type="submit" name="registration-form" value="Submit">
    </form>
    
</main>