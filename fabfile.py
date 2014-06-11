from fabric.api import *
from fabric.contrib.files import *
# ec2-23-20-59-31.compute-1.amazonaws.com
# ec2-54-81-165-93.compute-1.amazonaws.com
# ec2-54-213-241-15.us-west-2.compute.amazonaws.com
# ec2-54-186-68-23.us-west-2.compute.amazonaws.com

env.user = 'ubuntu'
env.remote_interrupt = True

# Final machines in farm
env.hosts = [
    'ec2-54-85-1-232.compute-1.amazonaws.com' #Predictopus01 East Virginia
]

env.LOG = '`ls -Rrt /var/code/apps/predictopus/logs/2014//*/*.php | tail -1`'

@parallel
def tail_logs():
    assert(env.remote_interrupt == True)
    with settings(warn_only=True):
        sudo("tail -f "+env.LOG)

def install():
    sudo('apt-get install apache2')
    sudo('apt-get install git')
    sudo ('apt-get install php5-cli')
    sudo('apt-get install php5-mysql')
    sudo('apt-get install php5-sqlite')
    sudo('apt-get install libapache2-mod-php5') 
    sudo('a2enmod rewrite')

def bootstrap():
#    sudo('mkdir /var/code')
#    sudo('git clone https://github.com/anshulsao/predictopus.git /var/code/')
#    sudo('rm -rf /var/www/predictopus')
#    sudo('ln -s /var/code/apps/predictopus/public /var/www/predictopus')
    with cd('/var/code/fuelfwk'):
        sudo('php composer.phar self-update')
        sudo('rm -rf /var/code/fuelfwk/fuel/vendor/')
        sudo('php composer.phar install')
        sudo('mv /etc/apache2/sites-enabled/000-default.conf /etc/apache2/sites-enabled/000-default.conf.bak')
        sudo('ln -s  /var/code/000-default /etc/apache2/sites-enabled/000-default.conf')
        sudo('php oil refine install')
        sudo('chmod 777 ../apps/predictopus/public/assets/cache/') 
        sudo('chmod 777 -R /var/code/apps/predictopus/logs')
        sudo('sudo chmod 777 -R /var/code/fuelfwk/fuel/core/classes/cache/')
        sudo('sudo chmod 777 -R /var/code/apps/predictopus/cache/')
        sudo('sudo chmod 777 -R /var/code/apps/predictopus/public/assets/cache/')
        sudo('service apache2 restart')


def deploy_to():
    with cd("/var/code"):
        #sudo("ls")
        print("Updating Code Repo")
        sudo("git stash") #not required unless you have been editing some code directly on the server
        sudo("git pull")
        #sudo("git stash pop")
        print("Code Pulled. Now Clearing Cache and Restarting server")
        sudo("rm -rf apps/predictopus/cache/*.cache")
        sudo('service apache2 restart')


    
    
