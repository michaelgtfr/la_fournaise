Feature:
  in order to check that the features that the page works
  As a user
  I want to have these scenarios

  Scenario: Display the contactForm page
    Given I go to "/contact"
    Then I should see "Formulaire de contact:"


    Scenario: contact forms testing
      Given I go to "/contact"
      When I fill in "Nom" with "usernameTest"
      And I fill in "Email" with "emailtest@gmail.com"
      And I fill in "Votre message" with "content Test"
      And I press "Valider"
      Then I should see "Votre email à été envoyé."