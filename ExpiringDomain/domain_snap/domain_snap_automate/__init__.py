import sys
import time
from selenium import webdriver
from webdriver_manager.chrome import ChromeDriverManager
#from colorama.initialise import deinit
from Tools.scripts.dutree import display
from _ast import Try
driver = webdriver.Chrome(ChromeDriverManager().install())

driver.maximize_window()

driver.delete_all_cookies()
driver.set_page_load_timeout(10)
driver.implicitly_wait(10)
driver.get('https://snapnames.com/store/getStoreFrontPage.action?storeName=domainerPlus&sid=1629702669922')
time.sleep(10)
driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/select').click()
driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/select').send_keys('500')
driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/select').click()
time.sleep(20)
driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[1]/div[1]/div[2]/div/div[3]/a/img').click()
'''for i in range(235):
    def check(display):
        return (bool(display == driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').isDisplayed()))
        time.sleep(10)
    try:    
        if(check):
            driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').click()
            time.sleep(10)
        else :
            driver.refresh()
            time.sleep(2)
            driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').click()
            time.sleep(10)
    except :
        print()'''
for i in range(1288):
    def check(display):
        return (bool(display == driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').isDisplayed()))
        time.sleep(10)
    try:
        if(check):
            driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').click()
            time.sleep(15)
            driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[1]/div[1]/div[2]/div/div[3]/a/img').click()
            time.sleep(20)
        else :
            driver.refresh()
            time.sleep(20)
            driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').click()
            time.sleep(15)
            driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[1]/div[1]/div[2]/div/div[3]/a/img').click()
            time.sleep(20)
    except :
        print()
    '''def check(display):
        return (bool(display == driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').isDisplayed()))
    driver.find_element_by_xpath('/html/body/div[2]/div/div/div[2]/div[4]/div[7]/div[1]/div[2]/div[2]/button[3]').click()
    time.sleep(15)'''
        