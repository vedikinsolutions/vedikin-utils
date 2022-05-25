using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace GD_Reminder
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();

            tmrReminder.Interval = int.Parse(txtIntervalTime.Text) * 1000;
            StartTimer();
        }

        private void tmrReminder_Tick(object sender, EventArgs e)
        {
            // System.Diagnostics.Process.Start(@"csscript reminderscript.vbs");

            Process scriptProc = new Process();
            scriptProc.StartInfo.FileName = @"cscript";
            scriptProc.StartInfo.WorkingDirectory = Directory.GetCurrentDirectory();
            scriptProc.StartInfo.Arguments = "//B //Nologo reminderscript.vbs";
            scriptProc.StartInfo.WindowStyle = ProcessWindowStyle.Hidden; //prevents console window from popping out
            scriptProc.Start();
            // scriptProc.WaitForExit(); //(Optional)
            scriptProc.Close();

            MessageBox.Show("Please check GD");
        }

        private void btnTimer_Click(object sender, EventArgs e)
        {
            StartTimer();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            stopTimer();
        }

        private void StartTimer() {
            tmrReminder.Stop();
            tmrReminder.Interval = int.Parse(txtIntervalTime.Text) * 1000;
            txtIntervalTime.Enabled = false;
            tmrReminder.Start();

            btnStartTimer.Enabled = false;
            btnStopTimer.Enabled = true;
        }

        private void stopTimer() {
            tmrReminder.Stop();
            btnStartTimer.Enabled = true;
            btnStopTimer.Enabled = false;
            txtIntervalTime.Enabled = true;
        }
    }
}
