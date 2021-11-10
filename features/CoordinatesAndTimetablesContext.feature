Feature:
  in order to check that the features that the page works
  As a user
  I want to have these scenarios

  Scenario:
    Given I am logged in as an admin
    When I go to "/admin/coordonneesethoraires"
    Then I should see "Les coordonnées et horaires:"